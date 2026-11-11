<?php
include '../formconnection.php'; // Include your database connection file

try {
    // Read variables
    $EmployeeCode = isset($_POST['EmployeeCode']) ? $_POST['EmployeeCode'] : '';
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    $Department = isset($_POST['Department']) ? $_POST['Department'] : '';

    // Debug: Log input variables to ensure they are being read correctly
    error_log("EmployeeCode: " . $EmployeeCode);
    error_log("StartDate: " . $startDate);
    error_log("EndDate: " . $endDate);
    error_log("Department: " . $Department);

    // Ensure the correct database is selected
    $conn->select_db('dialoguesmedia');

    // Call the stored procedure
    $sql = "CALL GetRoasterData(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error preparing SQL statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $EmployeeCode, $startDate, $endDate, $Department);

    // Execute the prepared statement
    if (!$stmt->execute()) {
        throw new Exception("Error executing SQL query: " . $stmt->error);
    }

    // Get result set
    $result = $stmt->get_result();

    if ($result !== false) {
        $roasterData = array();
        while ($row = $result->fetch_assoc()) {
            $roasterData[] = $row;
        }
        if (empty($roasterData)) {
            echo json_encode(array('status' => 'error', 'message' => 'No data found!'));
        } else {
            echo json_encode(array('status' => 'success', 'data' => $roasterData));
        }

    } else {
        throw new Exception("Error fetching result set: " . $stmt->error);
    }
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

// Close the statement
if ($stmt) {
    $stmt->close();
}

// Close the connection
$conn->close();
?>