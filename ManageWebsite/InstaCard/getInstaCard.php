<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../formconnection.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch all insta_posts ordered by features and creation date
$sql = "SELECT * FROM insta_posts ORDER BY created_at DESC";
$result = $conn->query($sql);

$posts = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Optionally prepend base path if file is relative
        $row['file'] = $row['file']; // Or prepend with base URL if needed
        $posts[] = $row;
    }

    echo json_encode([
        "success" => true,
        "data" => $posts
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "No posts found"
    ]);
}

$conn->close();
?>
