<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../formconnection.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

if (!isset($_POST["name"]) || !isset($_FILES["image"])) {
    echo json_encode(["success" => false, "message" => "Missing gallery name or main image"]);
    exit;
}

$name = $_POST["name"];
$created_at = date("Y-m-d H:i:s");

// Define upload directory: uploads/photogallery
$baseUploadDir = realpath(__DIR__ . '/../') . "/uploads";
if (!is_dir($baseUploadDir)) {
    mkdir($baseUploadDir, 0777, true);
}

$galleryImageDir = $baseUploadDir . "/photogallery";
if (!is_dir($galleryImageDir)) {
    mkdir($galleryImageDir, 0777, true);
}

// Upload main image
$imageExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$imageName = uniqid("main_") . "." . $imageExt;
$imageTarget = $galleryImageDir . "/" . $imageName;
$imagePath = "uploads/photogallery/" . $imageName;

if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imageTarget)) {
    echo json_encode(["success" => false, "message" => "Failed to upload main image"]);
    exit;
}

// Upload subimages (optional)
$subimagePaths = [];

if (!empty($_FILES["subimage"]["name"][0])) {
    foreach ($_FILES["subimage"]["tmp_name"] as $index => $tmpName) {
        $subExt = pathinfo($_FILES["subimage"]["name"][$index], PATHINFO_EXTENSION);
        $subName = uniqid("sub_") . "_" . $index . "." . $subExt;
        $subTarget = $galleryImageDir . "/" . $subName;
        $subPath = "uploads/photogallery/" . $subName;

        if (move_uploaded_file($tmpName, $subTarget)) {
            $subimagePaths[] = $subPath;
        }
    }
}

$subimagesJson = json_encode($subimagePaths);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO photogallery (name, image, subimage, created_at) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssss", $name, $imagePath, $subimagesJson, $created_at);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Gallery created successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Database insert failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
