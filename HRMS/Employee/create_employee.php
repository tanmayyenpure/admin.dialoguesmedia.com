<?php
include '../formconnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emp_id = $_POST['emp_id'];
        $name = $_POST['name'];
        $aadhar_card_no = $_POST['aadhar_card_no'];
        $pan_card = $_POST['pan_card'];
        $mobile_number = $_POST['mobile_number'];
        $department_type = $_POST['department_type'];
        $project_id = $_POST['project_id'];
        $job_role = $_POST['job_role'];

        // Dictionary to map department_type to department_name
        $departmentMappings = [
            1 => 'HR',
            2 => 'Marketing',
            3 => 'Sales',
            4 => 'Web',
            5 => 'Others',
            // Add more mappings as needed
        ];

        // Check if department_type exists in the dictionary
        if (array_key_exists($department_type, $departmentMappings)) {
            $department_name = $departmentMappings[$department_type];

            // Insert project_id for department_type = 2
            // if ($department_type == 2) {
            //     $sql = "INSERT INTO employees (emp_id, name, aadhar_card_no, pan_card, mobile_number, department_name, department_type, project_id, job_role) 
            //             VALUES ('$emp_id', '$name', '$aadhar_card_no', '$pan_card', '$mobile_number', '$department_name','$department_type', '$project_id', '$job_role')";
            // } else {
            //     $sql = "INSERT INTO employees (emp_id, name, aadhar_card_no, pan_card, mobile_number, department_name,department_type, job_role) 
            //             VALUES ('$emp_id', '$name', '$aadhar_card_no', '$pan_card', '$mobile_number', '$department_name','$department_type', '$job_role')";
            // }

            $sql = "INSERT INTO employees (emp_id, name, aadhar_card_no, pan_card, mobile_number, department_name, job_role) 
                        VALUES ('$emp_id', '$name', '$aadhar_card_no', '$pan_card', '$mobile_number', '$department_name','$job_role')";

            if ($conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'Employee added successfully!';
            } else {
                throw new Exception('Error: ' . $sql . '<br>' . $conn->error);
            }
        } else {
            throw new Exception('Invalid department_type value');
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Caught exception: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
