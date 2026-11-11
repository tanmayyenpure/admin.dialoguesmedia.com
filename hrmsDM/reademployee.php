<?php
include 'formconnection.php';

try {
    if (isset($_GET['emp_id'])) 
    {
        $emp_id = $_GET['emp_id'];
        $sql = "SELECT * FROM employees WHERE emp_id = '$emp_id'";
    } 
    else 
    {
        $emp_id = ''; 
        $sql = "SELECT emp_id, name, pan_card FROM employees";// Set a default value or leave it empty for all employees
    }
   
    $result = $conn->query($sql);
    $employees = array();

    if ($result->num_rows > 0) {
        if ($result->num_rows == 1) 
        {
            $employees = $result->fetch_assoc();
        }
        else
        {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        }
    }

    echo json_encode(array('status' => 'success', 'data' => $employees));
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>


