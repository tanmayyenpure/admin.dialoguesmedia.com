<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../formconnection.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT * FROM shortfilms WHERE type = 'Short Film' ORDER BY created_at DESC ";
$result = $conn->query($sql);

$shortfilms = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shortfilms[] = $row;
    }
    echo json_encode(["success" => true, "data" => $shortfilms]);
} else {
    echo json_encode(["success" => true, "data" => [], "message" => "No short films found"]);
}

$conn->close();
?>
