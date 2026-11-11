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

// Fetch all entries
$query = "SELECT id, name, image, subimage, created_at FROM photogallery";
$result = $conn->query($query);

$gallery = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Decode subimage JSON into array
        $row['subimage'] = json_decode($row['subimage'], true);
        $gallery[] = $row;
    }

    echo json_encode([
        "success" => true,
        "data" => $gallery
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Query failed: " . $conn->error
    ]);
}

$conn->close();
?>
