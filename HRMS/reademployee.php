<?php
include '../formconnection.php';

// Set timezone to India Standard Time
date_default_timezone_set('Asia/Kolkata');

try {
    // If emp_id is passed in GET, fetch specific employee
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
        $emp_id = $_GET['emp_id'];

        $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id = ?");
        $stmt->bind_param("s", $emp_id); // Use "i" if emp_id is an integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(array('status' => 'error', 'message' => 'No employee found.'));
            exit;
        }

        $employee = $result->fetch_assoc();
        echo json_encode(array('status' => 'success', 'data' => $employee));
    } else {
        // Fetch all employees
        $sql = "SELECT * FROM employees ORDER BY emp_id ASC";
        $result = $conn->query($sql);

        if (!$result) {
            echo json_encode(array('status' => 'error', 'message' => $conn->error));
            exit;
        }

        $employees = array();
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }

        echo json_encode(array('status' => 'success', 'data' => $employees));
    }
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>
