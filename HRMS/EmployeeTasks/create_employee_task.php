<?php
require '../formconnection.php';

$response = array('status' => 'error', 'message' => 'Unknown error');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $attendance_date = $_POST['attendance_date'];
        $attendance = (int)$_POST['attendance'];
        $emp_id = (string)$_POST['emp_id'];
        $reason = isset($_POST['reason']) ? (string)$_POST['reason'] : '';

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO employeetasks (attendance_date, attendance, emp_id, ab_reason) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $attendance_date, $attendance, $emp_id, $reason);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'EmployeeTask created successfully!';
        } else {
            throw new Exception('Error: ' . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $response['message'] = 'Caught exception: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
