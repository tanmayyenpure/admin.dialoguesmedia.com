<?php
include '../formconnection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emp_id = $_POST['emp_id'];
        $name = $_POST['name'];
        $aadhar_card_no = $_POST['aadhar_card_no'];
        $pan_card = $_POST['pan_card'];
        $mobile_number = $_POST['mobile_number'];
        $department_name = $_POST['department_name'];
        $project = $_POST['project_id']; // Assuming this is the new 'project' column
        $job_role = $_POST['job_role'];

        $stmt = $conn->prepare("UPDATE employees 
            SET name = ?, aadhar_card_no = ?, pan_card = ?, mobile_number = ?, 
                department_name = ?, project = ?, job_role = ?
            WHERE emp_id = ?");
        $stmt->bind_param("ssssssss", $name, $aadhar_card_no, $pan_card, $mobile_number, $department_name, $project, $job_role, $emp_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Employee updated successfully!']);
        } else {
            throw new Exception("Update failed: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
