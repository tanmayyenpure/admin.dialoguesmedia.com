<?php
require '../formconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Read raw input data (for JSON requests)
        $postData = json_decode(file_get_contents('php://input'), true);

        // Fallback to normal $_POST if JSON decoding fails
        if (!$postData) {
            $postData = $_POST;
        }

        if (!isset($postData['task_id']) || !isset($postData['type'])) {
            throw new Exception("Missing required parameters: task_id or type.");
        }

        $task_id = $conn->real_escape_string($postData['task_id']);
        $type = $conn->real_escape_string($postData['type']);

        // Define fields for tasks, work done, backlog, and new time-specific tasks
        $fields = [];

        for ($i = 1; $i <= 20; $i++) {
            $fields[] = "task$i";
            $fields[] = "workdone$i";
        }

        for ($i = 1; $i <= 10; $i++) {
            $fields[] = "backlog$i";
        }

        // Add the four new fields
        $fields[] = "task12pm";
        $fields[] = "task2pm";
        $fields[] = "task4pm";
        $fields[] = "task6pm";

        // Other fields
        $fields[] = "reason";

        // Set timestamps
        $datetimeValue = date('Y-m-d H:i:s');
        $opening_time = null;
        $closing_time = null;

        if ($type === 'opening') {
            $opening_time = $datetimeValue;
        } elseif ($type === 'closing') {
            $closing_time = $datetimeValue;
        }

        $setClauses = [];

        foreach ($fields as $field) {
            if (array_key_exists($field, $postData)) {
                $value = ($postData[$field] !== '' && $postData[$field] !== null) ? 
                         "'" . $conn->real_escape_string($postData[$field]) . "'" : "NULL";
                $setClauses[] = "`$field` = $value";
            }
        }

        if ($opening_time !== null) {
            $setClauses[] = "opening_time = '$opening_time'";
        }

        if ($closing_time !== null) {
            $setClauses[] = "closing_time = '$closing_time'";
        }

        if (empty($setClauses)) {
            throw new Exception("No valid fields to update.");
        }

        $sql = "UPDATE employeetasks SET " . implode(', ', $setClauses) . " WHERE task_id = '$task_id'";
        file_put_contents("debug_sql.txt", $sql); // Log SQL query for debugging

        if ($conn->query($sql) === true) {
            $response = [
                'status' => 'success',
                'message' => 'Employee task updated successfully!'
            ];
        } else {
            throw new Exception('Database error: ' . $conn->error);
        }
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => 'Caught exception: ' . $e->getMessage()
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
