<?php
include '../formconnection.php';

// Check if 'id' is set in GET
if(isset($_GET['media_id'])) {
    $id = $_GET['media_id'];
    $sql = "SELECT * FROM `media` WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Fetch and encode the image as base64
        // /$imageData = base64_encode($row['image']);

        // Include the image data in the response
        // $row['image'] = $imageData;

        // Send JSON response with the selected data
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $row]);
    } else {
        // If the query fails, send an error response  
        header('Content-Type: application/json');  
        echo json_encode(['status' => 'error', 'message' => 'Error executing query: ' . $conn->error]);
    }
} else {
    // If 'id' is not set in GET, send an error response
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'ID not provided in GET request']);
}

// Close the database connection
$conn->close();

