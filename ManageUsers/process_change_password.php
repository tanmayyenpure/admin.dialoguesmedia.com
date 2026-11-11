<?php
session_start();
require '../formconnection.php';  // Database connection

// ✅ Check for form data
if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword'])) {
    echo "missing_data";
    exit;
}

$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

// ✅ Check if the old password exists in the database
$sql = "SELECT password FROM users WHERE password = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "query_error";
    exit;
}

$stmt->bind_param("s", $oldPassword);
$stmt->execute();
$stmt->store_result();

// ✅ If old password exists, update to the new password
if ($stmt->num_rows > 0) {
    $stmt->close();

    // ✅ Prepare the UPDATE query
    $update_sql = "UPDATE users SET password = ? WHERE password = ?";
    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        echo "update_error";
        exit;
    }

    $update_stmt->bind_param("ss", $newPassword, $oldPassword);
    $update_stmt->execute();

    if ($update_stmt->affected_rows > 0) {
        echo "success";  // Password updated successfully
    } else {
        echo "update_failed";  // Failed to update
    }

    $update_stmt->close();
} else {
    echo "invalid_old_password";  // Old password is incorrect
}

$conn->close();
?>
