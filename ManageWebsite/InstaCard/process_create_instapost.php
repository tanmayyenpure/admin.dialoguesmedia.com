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

// Validate required fields (fix: use 'media' instead of 'file')
if (!isset($_POST['heading'], $_POST['description'], $_POST['features']) || !isset($_FILES['media'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$heading = mysqli_real_escape_string($conn, $_POST['heading']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$features = mysqli_real_escape_string($conn, $_POST['features']);
$link = isset($_POST['link']) ? mysqli_real_escape_string($conn, $_POST['link']) : '';

// Set up upload directory
$uploadDir = dirname(__DIR__) . '/uploads/instaposts/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$fileName = basename($_FILES['media']['name']);
$targetFile = $uploadDir . $fileName;
$dbFilePath = 'uploads/instaposts/' . $fileName;

// Detect file type
$mimeType = mime_content_type($_FILES['media']['tmp_name']);
if (strpos($mimeType, 'image') === 0) {
    $type = 'image';
} elseif (strpos($mimeType, 'video') === 0) {
    $type = 'video';
} else {
    $type = 'file';
}

if (move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO insta_posts (heading, description, type, file, link, features) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $heading, $description, $type, $dbFilePath, $link, $features);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Instagram post created successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "File upload failed"]);
}

$conn->close();
?>
