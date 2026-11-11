<?php
include '../formconnection.php';  // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_id = $_POST['emp_id'];

    // Prioritize the custom reason if it exists
    $final_reason = !empty($_POST['other_reason']) ? $_POST['other_reason'] : $_POST['ab_reason'];

    // Validate date selection
    $monthYear = $_POST['month'];
    list($selected_year, $selected_month) = explode('-', $monthYear);

    $selected_day = isset($_POST['day']) ? (int)$_POST['day'] : 1;
    $days = (int)$_POST['daysDropdown'];

    // Ensure valid date
    if (!checkdate($selected_month, $selected_day, $selected_year)) {
        echo "Invalid date selected.";
        exit;
    }

    $start_date = date('Y-m-d', strtotime("$selected_year-$selected_month-$selected_day"));

    $errors = [];
    $successCount = 0;

    for ($i = 0; $i < $days; $i++) {
        $date = date('Y-m-d', strtotime("+$i days", strtotime($start_date)));

        // Check if the day is a Sunday (0 = Sunday)
        if (date('w', strtotime($date)) == 0) {
            // Skip Sundays
            continue;
        }

        // Check for duplicates
        $checkSql = "SELECT * FROM employeetasks WHERE emp_id = ? AND attendance_date = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param('ss', $emp_id, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Record for $emp_id on $date already exists.";
            continue;
        }

        // Insert into the database with the final reason
        $sql = "INSERT INTO employeetasks (emp_id, ab_reason, attendance, attendance_date) 
                VALUES (?, ?, 0, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $emp_id, $final_reason, $date);

        if ($stmt->execute()) {
            $successCount++;
        } else {
            $errors[] = "Error inserting record for $date: " . $stmt->error;
        }
    }

    // Display results
    if ($successCount > 0) {
        echo "Records added successfully for $successCount days (excluding Sundays).<br>";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
