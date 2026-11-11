<?php
include '../formconnection.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM media";

    if (isset($_GET['id'])) {
        $media_id = $_GET['id'];
        $sql .= " WHERE id = '$media_id'";
    }
   
    $result = $conn->query($sql);
    $media = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $media[] = $row;
        }
    }

    echo json_encode(array('status' => 'success', 'data' => $media));
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>
