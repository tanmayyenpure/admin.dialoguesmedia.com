<?php
include '../formconnection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
        // Fetch specific employee by emp_id (VARCHAR)
        $emp_id = $_GET['emp_id'];

        $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id = ?");
        $stmt->bind_param("s", $emp_id); // "s" for string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'No employee found with emp_id ' . $emp_id
            ]);
            exit;
        }

        $employee = $result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'data' => [$employee] // Return as array for consistency
        ]);
    } else {
        // Fetch all employees
        $sql = "SELECT * FROM employees ORDER BY emp_id ASC";
        $result = $conn->query($sql);

        if (!$result) {
            echo json_encode([
                'status' => 'error',
                'message' => $conn->error
            ]);
            exit;
        }

        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $employees
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Caught exception: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
