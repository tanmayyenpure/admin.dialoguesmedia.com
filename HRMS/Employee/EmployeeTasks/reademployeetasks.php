<?php
require '../formconnection.php';

try {
    if (isset($_GET['emp_id'])) {
        $emp_id = $_GET['emp_id'];
        $sql = "SELECT * FROM employeetasks  WHERE emp_id = '$emp_id' ORDER BY attendance_date DESC";
    } 
    else 
    {
        throw new Exception("emp_id is required");
    }
    $employee_tasks = null;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($result->num_rows == 1) {
            $employee_tasks[] = $result->fetch_assoc();
        }
        else
        {
            $employee_tasks = array();
            while ($row = $result->fetch_assoc()) {
            
                $employee_tasks[] = $row;
            }
        }
    }

    $response = array('status' => 'success', 'data' => $employee_tasks);
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>

