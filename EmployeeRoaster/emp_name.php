<?php
header('Content-Type: application/json');
include '../formconnection.php'; // Include your database connection

if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];
    
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT name, job_role FROM employees WHERE emp_id = ?");
    $stmt->bind_param("s", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode(['name' => $row['name'], 'department' => $row['job_role']]);
    } else {
        echo json_encode(['name' => null, 'department' => null]);
    }
    
    $stmt->close();
}
$conn->close();
?>
