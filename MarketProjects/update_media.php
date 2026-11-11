<?php
include '../formconnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Assuming that 'DOJ_ID' is an auto-incremented primary key
        $id = $_POST['id'];
        $name = $_POST['name'];
        $value = $_POST['value'];

        $sql = "UPDATE `media` SET `$name` = '$value' WHERE `id` = $id";

        if ($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'Record updated successfully!';
        } else {
            throw new Exception('Error: ' . $sql . '<br>' . $conn->error);
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Caught exception: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
