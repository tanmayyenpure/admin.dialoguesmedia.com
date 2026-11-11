<?php
require '../formconnection.php';

header("Content-Type: application/json");

if (!isset($_GET['task_id']) || empty($_GET['task_id'])) {
    echo json_encode(["status" => "error", "message" => "Task ID is missing"]);
    exit;
}

$task_id = intval($_GET['task_id']); // Convert task_id to integer

// Optional date filter
$date = isset($_GET['date']) ? $_GET['date'] : null; 

// Validate the date format if provided
if ($date && !preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
    echo json_encode(["status" => "error", "message" => "Invalid date format. Use YYYY-MM-DD"]);
    exit;
}

// SQL query to fetch messages based on task_id (and optional date filter)
if ($date) {
    $sql = "SELECT COALESCE(employeemsg, '') AS employeemsg, COALESCE(hrmsg, '') AS hrmsg, timestamp 
            FROM messages 
            WHERE task_id = ? AND DATE(timestamp) = ? 
            ORDER BY timestamp ASC";
} else {
    $sql = "SELECT COALESCE(employeemsg, '') AS employeemsg, COALESCE(hrmsg, '') AS hrmsg, timestamp 
            FROM messages 
            WHERE task_id = ? 
            ORDER BY timestamp ASC";
}

$stmt = $conn->prepare($sql);

if ($date) {
    $stmt->bind_param("is", $task_id, $date);
} else {
    $stmt->bind_param("i", $task_id);
}

$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$stmt->close();
$conn->close();

// Return JSON response
if (!empty($messages)) {
    echo json_encode(["status" => "success", "data" => $messages]);
} else {
    echo json_encode(["status" => "error", "message" => "No messages found for this task_id"]);
}
?>
