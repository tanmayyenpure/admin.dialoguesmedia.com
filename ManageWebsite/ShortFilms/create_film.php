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
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

if (
    !isset($_POST["title"]) || 
    !isset($_POST["description"]) || 
    !isset($_POST["type"]) || 
    !isset($_FILES["video"])
) {
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

$title = $_POST["title"];
$description = $_POST["description"];
$type = $_POST["type"];
$created_at = date("Y-m-d H:i:s");

// Step 1: Go one level up from current directory
$baseUploadDir = realpath(__DIR__ . '/../') . "/uploads";

// Step 2: Check if base uploads folder exists
if (!is_dir($baseUploadDir)) {
    mkdir($baseUploadDir, 0777, true);
}

// Step 3: Create subfolder for short_film videos
$shortFilmDir = $baseUploadDir . "/short_film";
if (!is_dir($shortFilmDir)) {
    mkdir($shortFilmDir, 0777, true);
}

// Step 4: Prepare file paths
$videoExt = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
$videoName = uniqid("film_") . "." . $videoExt;
$targetFile = $shortFilmDir . "/" . $videoName;

// File path to store in DB
$videoPath = "uploads/short_film/" . $videoName;

// Optional debug
file_put_contents("debug_shortfilm_upload.log", print_r($_FILES["video"], true), FILE_APPEND);

if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO shortfilms (title, description, type, video, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $type, $videoPath, $created_at);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Short film uploaded successfully"]);
    } else {
        file_put_contents("debug_shortfilm_upload.log", "DB ERROR: " . $stmt->error . PHP_EOL, FILE_APPEND);
        echo json_encode(["success" => false, "message" => "Database insert failed"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Failed to move uploaded video"]);
}

$conn->close();
?>
