<?php
include '../formconnection.php'; // Ensure this path is correct

// Check if the date parameter is provided
if (!isset($_GET['date'])) {
    echo json_encode(['error' => 'Date parameter is missing']);
    exit;
}

$date = $_GET['date'];

// Validate the date format (YYYY-MM-DD)
if (!DateTime::createFromFormat('Y-m-d', $date)) {
    echo json_encode(['error' => 'Invalid date format']);
    exit;
}

// Fetch the reason and attendance status
$query = "SELECT ab_reason, attendance FROM employeetasks WHERE attendance_date = ?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt === false) {
    echo json_encode(['error' => 'Prepare failed: ' . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt, 's', $date);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode(['reason' => $row['ab_reason'], 'attendance' => $row['attendance']]);
} else {
    echo json_encode(['reason' => 'No reason available', 'attendance' => '0']);
}

// Close connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
