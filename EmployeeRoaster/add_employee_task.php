<?php
include '../formconnection.php'; // Make sure this path is correct
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $emp_id = $_POST['emp_id'];
    $ab_reason = $_POST['ab_reason'];
    $days = (int)$_POST['daysDropdown']; // Get the selected number of days as an integer
    $current_date = date('Y-m-d'); // Get current date
    $errors = []; // To store error messages for duplicates
    $successCount = 0; // Track successful inserts

    // Loop through each day and insert into the table
    for ($i = 0; $i < $days; $i++) {
        $date = date('Y-m-d', strtotime("+$i days", strtotime($current_date))); // Calculate each date

        // Check if a record already exists for this emp_id and date
        $checkSql = "SELECT * FROM employeetasks WHERE emp_id = '$emp_id' AND attendance_date = '$date'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            // Record already exists for this date
            $errors[] = "Error: Record for emp_id $emp_id on date $date already exists.";
            continue; // Skip this day and continue with the next
        }

        // Prepare the insert query for each day if no duplicate is found
        $sql = "INSERT INTO employeetasks (emp_id, ab_reason, attendance, attendance_date) 
                VALUES ('$emp_id', '$ab_reason', 0, '$date')";

        if ($conn->query($sql)) {
            $successCount++; // Increment success counter
        } else {
            $errors[] = "Error inserting record for date $date: " . $conn->error;
            break; // Stop if there's an error in insertion
        }
    }

    // Show success message for successfully inserted records
    if ($successCount > 0) {
        echo "Records added successfully for $successCount days.<br>";
    }

    // Show errors for duplicates or insertion failures
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    $conn->close();
}
?>
