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

if (
    !isset($_POST['name']) || 
    !isset($_POST['info']) || 
    !isset($_POST['gender']) || 
    !isset($_FILES['image'])
) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$name = $_POST['name'];
$info = $_POST['info'];
$gender = $_POST['gender'];
$created_at = date("Y-m-d H:i:s");

// Set upload path
$baseUploadDir = realpath(__DIR__ . '/../') . "/uploads";
if (!is_dir($baseUploadDir)) {
    mkdir($baseUploadDir, 0777, true);
}

$modelImageDir = $baseUploadDir . "/models";
if (!is_dir($modelImageDir)) {
    mkdir($modelImageDir, 0777, true);
}

// Get image file extension
$imageExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$imageName = uniqid("model_") . "." . $imageExt;
$targetFile = $modelImageDir . "/" . $imageName;
$imagePath = "uploads/models/" . $imageName;

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO models (image, name, gender, info, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $imagePath, $name, $gender, $info, $created_at);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Model created successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database insert failed: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Failed to upload image"]);
}

$conn->close();
?>
