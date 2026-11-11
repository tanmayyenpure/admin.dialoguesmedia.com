<?php
include '../formconnection.php';

try {
    // Debug: Log to verify the presence of the filename parameter
    error_log("Received parameters: " . json_encode($_GET));

    if (isset($_GET['filename'])) {
        $filename = $_GET['filename'] . 'DepartmentFilter.txt'; // Add ".txt" at the end

        // Debug: Log the filename
        error_log("Filename: " . $filename);

        // Read SQL query from the text file
        $sql = file_get_contents($filename);

        if (!$sql) {
            throw new Exception("Error reading SQL query from the file");
        }

        $query_data = null;
        $result = $conn->query($sql);

        if ($result !== false) {
            if ($result->num_rows > 0) {
                if ($result->num_rows == 1) {
                    $query_data[] = $result->fetch_assoc();
                } else {
                    $query_data = array();
                    while ($row = $result->fetch_assoc()) {
                        $query_data[] = $row;
                    }
                }
            }
            echo json_encode(array('status' => 'success', 'data' => $query_data));
        } else {
            throw new Exception("Error executing SQL query");
        }
    } else {
        throw new Exception("Filename is required");
    }
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>