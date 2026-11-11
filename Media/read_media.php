<?php
include '../formconnection.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT id, name, designation, company, address, mobile, email, city, state, pincode, date, visitor, location, feedback FROM media";

    if (isset($_GET['id'])) {
        $media_id = $_GET['id'];
        $sql .= " WHERE id = '$media_id'";
    }
   
    $result = $conn->query($sql);
    $media = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add each row to the $media array
            $media[] = $row;
        }
    }

    // Output the JSON data
    echo json_encode(array('status' => 'success', 'data' => $media));
} catch (Exception $e) {
    // Output JSON error message if an exception occurs
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

// Close the database connection
$conn->close();
?>
