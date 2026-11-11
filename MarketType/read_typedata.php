<?php
include '../formconnection.php';
//header('Content-Type: application/json');
$response = [];
try {
    if (isset($_GET['project_id']) && isset ( $_GET['emp_id']) && isset( $_GET['Type'])) 
    {
        $project_id = $_GET['project_id'];
        $emp_id = $_GET['emp_id'];
        $type = $_GET['Type'];
        $sql = "SELECT m.*
        FROM media m 
        WHERE m.Type = '$type'
        AND m.project_id = '$project_id'
        AND m.emp_id = '$emp_id'";
    } 
    else 
    {
        throw new Exception("Some Error Not Found");
    }
   
    $result = $conn->query($sql);
    $data = array();

    if ($result->num_rows > 0) {
        if ($result->num_rows == 1) 
        {
            $data[] = $result->fetch_assoc();
        }
        else
        {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        }
    }

  $response = array('status' => 'success', 'data' => $data);
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>
