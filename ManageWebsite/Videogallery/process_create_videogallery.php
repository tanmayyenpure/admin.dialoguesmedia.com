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

// Validate input
if (!isset($_POST['title']) || !isset($_FILES['video']) || !isset($_FILES['image'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$title = $_POST['title'];
$created_at = date("Y-m-d H:i:s");

// Set base upload directory
$baseUploadDir = realpath(__DIR__ . '/../') . "/uploads";
if (!is_dir($baseUploadDir)) {
    mkdir($baseUploadDir, 0777, true);
}

// Handle image upload
$imageDir = $baseUploadDir . "/videogallary/images";
if (!is_dir($imageDir)) {
    mkdir($imageDir, 0777, true);
}

$imageExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$imageName = uniqid("img_") . "." . $imageExt;
$imageTarget = $imageDir . "/" . $imageName;
$imagePath = "uploads/videogallary/images/" . $imageName;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $imageTarget)) {
    echo json_encode(["success" => false, "message" => "Failed to upload image"]);
    exit;
}

// Handle video upload
$videoDir = $baseUploadDir . "/videogallary";
if (!is_dir($videoDir)) {
    mkdir($videoDir, 0777, true);
}

$videoExt = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
$videoName = uniqid("video_") . "." . $videoExt;
$videoTarget = $videoDir . "/" . $videoName;
$videoPath = "uploads/videogallary/" . $videoName;

if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoTarget)) {
    echo json_encode(["success" => false, "message" => "Failed to upload video"]);
    exit;
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO video_gallery (title, image, video, created_at) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $imagePath, $videoPath, $created_at);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Video and image uploaded successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Database insert failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
