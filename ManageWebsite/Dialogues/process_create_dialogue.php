<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../formconnection.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Validate required fields
if (!isset($_POST['title'], $_POST['category'], $_POST['video']) || !isset($_FILES['image'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$title = mysqli_real_escape_string($conn, $_POST['title']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$video = mysqli_real_escape_string($conn, $_POST['video']);

// ✅ Correct image folder location: one level up and into uploads/dialogues
$uploadDir = dirname(__DIR__) . '/uploads/dialogues/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$imageName = basename($_FILES['image']['name']);
$targetFile = $uploadDir . $imageName;
$imagePath = 'uploads/dialogues/' . $imageName; // for database

if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO dialogues (title, category, image, video) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $category, $imagePath, $video);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Dialogue created successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Image upload failed"]);
}

$conn->close();
?>
