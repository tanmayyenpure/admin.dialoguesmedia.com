<?php
include '../formconnection.php';

// Set timezone to India Standard Time
date_default_timezone_set('Asia/Kolkata');

try {
    // Get the date parameter from the request, default to current date if not provided
    $currentDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // SQL query to fetch all employees, their attendance for the specified date, and location from employeelogin
    $sql = "SELECT e.emp_id, e.name, e.department_name, 
       COALESCE(et.attendance, 'Not Marked') AS attendance, 
       COALESCE(latest_login.emp_location, 'Unknown') AS location
FROM employees e
LEFT JOIN employeetasks et 
    ON e.emp_id = et.emp_id 
    AND et.attendance_date = ?
LEFT JOIN (
    SELECT el1.emp_id, el1.emp_location 
    FROM employeelogins el1
    INNER JOIN (
        SELECT emp_id, MAX(login_time) AS latest_login_time
        FROM employeelogins
        GROUP BY emp_id
    ) el2 ON el1.emp_id = el2.emp_id AND el1.login_time = el2.latest_login_time
) latest_login ON e.emp_id = latest_login.emp_id 
WHERE e.department_name != 'HR' 
ORDER BY e.emp_id ASC;
"; 

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentDate); // Bind the date parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for SQL execution errors
    if (!$result) {
        echo json_encode(array('status' => 'error', 'message' => $conn->error));
        exit;
    }

    $employees = array();

    while ($row = $result->fetch_assoc()) {
        $employees[] = $row; // Collect employee data
    }

    echo json_encode(array('status' => 'success', 'data' => $employees));
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>
