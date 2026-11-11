<?php
include '../formconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emp_id = $_POST['emp_id'];
        $name = $_POST['name'];
        $aadhar_card_no = $_POST['aadhar_card_no'];
        $pan_card = $_POST['pan_card'];
        $mobile_number = $_POST['mobile_number'];
        $department_name = $_POST['department_name'];
        $job_role = $_POST['job_role'];
        $department_type = $_POST['department_type'];
        $project_id = $_POST['project_id'];

        // Mapping department_type to department_name
        $departmentMappings = [
            1 => 'HR',
            2 => 'Marketing',
            3 => 'Sales',
            4 => 'Web',
            5 => 'Others'
        ];

        // Check if department_type exists in the dictionary
        if (array_key_exists($department_type, $departmentMappings)) {
            $department_name = $departmentMappings[$department_type];

            // Set project_id for department_type = 2
            if ($department_type == 2) {
                $sql = "UPDATE employees 
                        SET name = '$name', 
                            aadhar_card_no = '$aadhar_card_no', 
                            pan_card = '$pan_card', 
                            mobile_number = '$mobile_number', 
                            department_name = '$department_name', 
                            department_type = '$department_type',
                            job_role = '$job_role', 
                            project_id = '$project_id' 
                        WHERE emp_id = '$emp_id'";
            } else {
                $sql = "UPDATE employees 
                        SET name = '$name', 
                            aadhar_card_no = '$aadhar_card_no', 
                            pan_card = '$pan_card', 
                            mobile_number = '$mobile_number', 
                            department_name = '$department_name',
                            department_type = '$department_type', 
                            job_role = '$job_role' 
                        WHERE emp_id = '$emp_id'";
            }

            if ($conn->query($sql) === TRUE) {
                echo json_encode(array('status' => 'success', 'message' => 'Employee updated successfully!'));
                $conn->close();
            } else {
                throw new Exception('Error updating employee: ' . $conn->error);
            }
        } else {
            throw new Exception('Invalid department_type value');
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
    }
}
?>
