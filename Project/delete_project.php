<?php
include '../formconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pid = $_POST['pid'];

        $sql = "DELETE FROM Project WHERE pid = '$pid'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Project deleted successfully!'));
        } else {
            throw new Exception('Error deleting Project: ' . $conn->error);
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
    }
}

$conn->close();
?>
