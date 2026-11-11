<?php
include '../formconnection.php'; // Ensure this path is correct

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$emp_id = $_POST['emp_id'];
$ab_reason = $_POST['ab_reason'];
$month = $_POST['month']; // Format: YYYY-MM
$day = $_POST['day']; // Day of the month from dropdown

// Validate inputs
if (empty($emp_id) || empty($ab_reason) || empty($month) || empty($day)) {
    die("Please fill in all fields.");
}

// Construct the attendance date in YYYY-MM-DD format
$attendance_date = $month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT); // Ensure day is two digits

// Validate the constructed date
$timestamp = strtotime($attendance_date);
if (!$timestamp || $attendance_date === '1970-01-01') {
    die("Invalid date. Please provide a valid date.");
}

// Check for existing record
$checkStmt = $conn->prepare("SELECT COUNT(*) FROM employeetasks WHERE emp_id = ? AND ab_reason = ? AND attendance_date = ?");
$checkStmt->bind_param("sss", $emp_id, $ab_reason, $attendance_date);
$checkStmt->execute();
$checkStmt->bind_result($count);
$checkStmt->fetch();
$checkStmt->close();

if ($count > 0) {
    echo "Duplicate entry found. Record not inserted.";
} else {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO employeetasks (emp_id, ab_reason, attendance, attendance_date) VALUES (?, ?, 0, ?)");
    $stmt->bind_param("sss", $emp_id, $ab_reason, $attendance_date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
