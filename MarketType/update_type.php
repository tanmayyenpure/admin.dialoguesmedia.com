<?php
include '../formconnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['ids'];
    $response = array(); // Initialize response array

    try {
        foreach ($ids as $id) {
            $sql = "UPDATE `media` SET Type = 2 WHERE `id` = $id";
            if ($conn->query($sql) !== TRUE) {
                throw new Exception('Error: ' . $sql . '<br>' . $conn->error);
            }
        }

        // If the loop completes without exceptions, set success response
        $response['status'] = 'success';
        $response['message'] = 'Records updated successfully!';
    } catch (Exception $e) {
        // If an exception is caught during the loop, set error response
        $response['status'] = 'error';
        $response['message'] = 'Caught exception: ' . $e->getMessage();
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
