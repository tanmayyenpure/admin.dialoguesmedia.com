<?php
include '../formconnection.php';

$response = null;

if (isset($media_id)) {
    try {
        $query = "SELECT `name`, `designation`, `mobile`, `email` FROM `media` WHERE id='$media_id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        }
    } catch (Exception $e) {
        throw new Exception($e);
    }

    $conn->close();
}
?>
