<?php
// Allow CORS (optional for API access from other origins)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Debugging - show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include DB connection
include '../../formconnection.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch all short reels
$sql = "SELECT id, title, video, created_at FROM short_reels ORDER BY created_at DESC";
$result = $conn->query($sql);

$shortReels = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shortReels[] = [
            "id" => $row["id"],
            "title" => $row["title"],
            "video" => $row["video"], // path like uploads/short_reel/reel_123.mp4
            "created_at" => $row["created_at"]
        ];
    }
    echo json_encode(["success" => true, "data" => $shortReels]);
} else {
    echo json_encode(["success" => false, "message" => "No short reels found"]);
}

$conn->close();
?>
