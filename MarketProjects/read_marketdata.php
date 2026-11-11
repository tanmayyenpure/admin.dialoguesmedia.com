<?php
include '../formconnection.php';
header('Content-Type: application/json');
try {
    if (isset($_GET['project_id'])) 
    {
        $project_id = $_GET['project_id'];
        $sql = "SELECT m.emp_id, e.name, COUNT(CASE WHEN m.Type = 1 THEN 1 ELSE NULL END) AS saved, COUNT(CASE WHEN m.Type = 2 THEN 1 ELSE NULL END) AS submit FROM media m INNER JOIN employees e ON e.emp_id = m.emp_id WHERE m.project_id = '$project_id' GROUP BY m.emp_id, e.name;";
    } 
    else 
    {
        throw new Exception("Project Not Found");
    }
   
    $result = $conn->query($sql);
    $projects = array();

    if ($result->num_rows > 0) {
        if ($result->num_rows == 1) 
        {
            $projects = $result->fetch_assoc();
        }
        else
        {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        }
    }

    echo json_encode(array('status' => 'success', 'data' => $projects));
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>
