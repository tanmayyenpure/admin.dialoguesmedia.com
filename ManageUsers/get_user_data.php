<?php
// Start session and include database connection
session_start();
include '../formconnection.php'; 

// Check if UID is provided in the URL
$uid = isset($_GET['uid']) ? intval($_GET['uid']) : 0;

// Initialize variables
$name = $username = $password = $role = '';
$access = [];
$view_access = $edit_access = $delete_access = [];

// Fetch user data if UID is provided
if ($uid > 0) {
    $query = "SELECT * FROM users WHERE uid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Populate form variables with existing data
        $name = $user['name'];
        $username = $user['username'];
        $password = '';  // Don't display password for security reasons
        $role = $user['role'];

        // Parse access data (comma-separated values)
        $access = explode(',', $user['access']);
        $view_access = explode(',', $user['view_access']);
        $edit_access = explode(',', $user['edit_access']);
        $delete_access = explode(',', $user['delete_access']);
    }
}
?>
