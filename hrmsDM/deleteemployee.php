<?php
include 'formconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emp_id = $_POST['emp_id'];

        $sql = "DELETE FROM employees WHERE emp_id = '$emp_id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Employee deleted successfully!'));
        } else {
            throw new Exception('Error deleting employee: ' . $conn->error);
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
    }
}

$conn->close();
?>




