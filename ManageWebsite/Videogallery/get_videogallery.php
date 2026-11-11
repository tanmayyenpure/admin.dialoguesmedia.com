<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../formconnection.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch videos including the image field
$sql = "SELECT id, title, image, video, created_at FROM video_gallery ORDER BY created_at DESC";
$result = $conn->query($sql);

$videos = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $videos[] = [
            "id" => $row["id"],
            "title" => $row["title"],
            "image" => $row["image"],     // 👈 Include image
            "video" => $row["video"],     // 👈 Video comes after image
            "created_at" => $row["created_at"]
        ];
    }

    echo json_encode(["success" => true, "videos" => $videos]);
} else {
    echo json_encode(["success" => true, "videos" => []]);
}

$conn->close();
?>