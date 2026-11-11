<?php
include '../formconnection.php'; // Ensure this file sets $conn

header('Content-Type: application/json');
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emp_id = $_POST['emp_id'];
        $name = $_POST['name'];
        $aadhar_card_no = $_POST['aadhar_card_no'];
        $pan_card = $_POST['pan_card'];
        $mobile_number = $_POST['mobile_number'];
        $department_name = $_POST['department_name'];
        $project = $_POST['project_id']; // Field name from form
        $job_role = $_POST['job_role'];

        $stmt = $conn->prepare("INSERT INTO employees (emp_id, name, aadhar_card_no, pan_card, mobile_number, department_name, project, job_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $emp_id, $name, $aadhar_card_no, $pan_card, $mobile_number, $department_name, $project, $job_role);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Employee added successfully!';
        } else {
            throw new Exception("Insert failed: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
