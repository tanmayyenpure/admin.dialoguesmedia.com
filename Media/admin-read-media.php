<?php
session_start();
require("../formconnection.php");

header('Content-Type: application/json');

$response = array();

// Get project_id from GET parameter or session
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;

if ($project_id) {
    // Query to fetch media data associated with the project ID
    $sql = "SELECT * FROM media WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any media records are found
    if ($result->num_rows > 0) {
        $media_data = array();
        while ($row = $result->fetch_assoc()) {
            $media_data[] = array(
                'id' => $row['id'],
                'emp_id' => $row['emp_id'],
                'name' => $row['name'],
                'designation' => $row['designation'],
                'company' => $row['company'],
                'address' => $row['address'],
                'mobile' => $row['mobile'],
                'email' => $row['email'],
                'city' => $row['city'],
                'state' => $row['state'],
                'pincode' => $row['pincode'],
                'date' => $row['date'],
                'visitor' => $row['visitor'],
                'location' => $row['location'],
                'image'=>$row['image']
                // Add other fields as needed
            );
        }
        $response['status'] = 'success';
        $response['data'] = $media_data;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No media found for this project.';
    }

    $stmt->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Project ID not provided or session expired.';
}

// Log SQL query and response for debugging
error_log("SQL Query: " . $sql);
error_log("Response: " . json_encode($response));

// Return JSON response
echo json_encode($response["data"]);
?>
