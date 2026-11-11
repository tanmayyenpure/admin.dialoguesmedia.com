<?php
include '../formconnection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Sanitize and retrieve form data
$uid = isset($_POST['uid']) ? intval($_POST['uid']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$role = isset($_POST['role']) ? trim($_POST['role']) : '';

// Combine access into a single string
$access = isset($_POST['access']) ? implode(',', (array)$_POST['access']) : '';
$view_access = isset($_POST['view_access']) ? implode(',', (array)$_POST['view_access']) : '';
$edit_access = isset($_POST['edit_access']) ? implode(',', (array)$_POST['edit_access']) : '';
$delete_access = isset($_POST['delete_access']) ? implode(',', (array)$_POST['delete_access']) : '';

// Validate required fields
if (!$uid || !$name || !$username || !$role) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

try {
    // Prepare the SQL statement
    if (!empty($password)) {
        // If password is provided, include it in the update
        $query = "UPDATE users 
                  SET name = ?, username = ?, role = ?, access = ?, view_access = ?, edit_access = ?, delete_access = ?, password = ?
                  WHERE uid = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssssssssi",
            $name,
            $username,
            $role,
            $access,
            $view_access,
            $edit_access,
            $delete_access,
            $password,     // Plain text password
            $uid
        );
    } else {
        // If no password, update all fields except password
        $query = "UPDATE users 
                  SET name = ?, username = ?, role = ?, access = ?, view_access = ?, edit_access = ?, delete_access = ?
                  WHERE uid = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssssssi",
            $name,
            $username,
            $role,
            $access,
            $view_access,
            $edit_access,
            $delete_access,
            $uid
        );
    }

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user.']);
    }

    // Clean up
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
