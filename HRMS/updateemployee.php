<?php
include 'formconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emp_id = $_POST['emp_id'];
        $name = $_POST['name'];
        $aadhar_card_no = $_POST['aadhar_card_no'];
        $pan_card = $_POST['pan_card'];
        $mobile_number = $_POST['mobile_number'];
        $department_name = $_POST['department_name'];
        $job_role = $_POST['job_role'];

        $sql = "UPDATE employees 
                SET name = '$name', 
                    aadhar_card_no = '$aadhar_card_no', 
                    pan_card = '$pan_card', 
                    mobile_number = '$mobile_number', 
                    department_name = '$department_name', 
                    job_role = '$job_role' 
                WHERE emp_id = '$emp_id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Employee updated successfully!'));
            $conn->close();
        } else {
            throw new Exception('Error updating employee: ' . $conn->error);
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
    }
}
?>

