<?php
include '../formconnection.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM Project";

    if (isset($_GET['pid'])) {
        $project_id = $_GET['pid'];
        $sql .= " WHERE pid = '$project_id'";
    }
   
    $result = $conn->query($sql);
    $projects = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }

    echo json_encode(array('status' => 'success', 'data' => $projects));
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>
