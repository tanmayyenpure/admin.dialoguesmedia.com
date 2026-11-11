<?php
// Database connection
include '../formconnection.php';

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Collect form data
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Ensure multiple access values are combined properly
$access = isset($_POST['access']) ? implode(',', $_POST['access']) : ''; 

// Collect individual access values
$view_access = isset($_POST['view_access']) ? implode(',', $_POST['view_access']) : '';
$edit_access = isset($_POST['edit_access']) ? implode(',', $_POST['edit_access']) : '';
$delete_access = isset($_POST['delete_access']) ? implode(',', $_POST['delete_access']) : '';

// Debug to confirm the combined string
error_log("Access: $access");

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, username, password, role, access, view_access, edit_access, delete_access) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => "Prepare failed: " . $conn->error]));
}

// Bind parameters
$stmt->bind_param("ssssssss", $name, $username, $password, $role, $access, $view_access, $edit_access, $delete_access);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => "New user created successfully"]);
} else {
    echo json_encode(['success' => false, 'message' => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();

?>
