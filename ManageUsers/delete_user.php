<?php
// Database connection
include '../formconnection.php'; 

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uid'])) {
    $uid = $_POST['uid'];

    // Delete the user by UID
    $stmt = $conn->prepare("DELETE FROM users WHERE uid = ?");
    $stmt->bind_param("i", $uid);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => "User deleted successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Failed to delete user."]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => "Invalid request."]);
}

$conn->close();
?>
