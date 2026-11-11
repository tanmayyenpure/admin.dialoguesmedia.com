<?php
require '../formconnection.php'; // Ensure database connection

header("Content-Type: application/json"); // Set response type as JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $task_id = $_POST['task_id'] ?? null;
        $hrmsg = $_POST['hrmsg'] ?? null;

        if (empty($task_id) || empty($hrmsg)) {
            echo json_encode(["status" => "error", "message" => "Task ID and Employee Message cannot be empty."]);
            exit;
        }

        // Prepare SQL query to insert message
        $stmt = $conn->prepare("INSERT INTO messages (task_id, employeemsg, hrmsg, timestamp) VALUES (? , NULL, ?, CURRENT_TIMESTAMP)");
        $stmt->bind_param("is", $task_id, $hrmsg);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Message submitted successfully!", "msg_id" => $stmt->insert_id]);
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }

        // Close statement
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
