<?php
include '../formconnection.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['emp_id'];
    $department = $_POST['department'];  // Assuming you need this column
    $ab_reason = $_POST['ab_reason'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Prepare the SQL query
    $sql = "INSERT INTO employeetasks (attendance, emp_id, ab_reason, attendance_date)
            VALUES (0, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Convert start and end dates to DateTime objects
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $end->modify('+1 day'); // Include end date in the range

    // Iterate over the date range and insert each date
    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($start, $interval, $end);

    foreach ($daterange as $date) {
        $attendance_date = $date->format("Y-m-d");
        $stmt->bind_param("sss", $emp_id, $ab_reason, $attendance_date);

        if (!$stmt->execute()) {
            echo "Error executing statement: " . $stmt->error;
            break; // Stop on first error
        }
    }

    if ($stmt->errno == 0) {
        echo "New records created successfully";
    }

    $stmt->close();
}

$conn->close();
?>