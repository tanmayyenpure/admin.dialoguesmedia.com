<?php
include 'formconnection.php';

try {
    // Get the employee ID and location from the request
    $employeeId = $_POST['employeeId'];
    $emp_location = $_POST['emp_location'];
    
    // echo $employeeId. ' '.$emp_location.' ';

    // Split the combined location string into latitude and longitude
    list($latitude, $longitude) = explode(',', $emp_location);

    // Check if the file is uploaded successfully
    if (isset($_FILES['empImage']) && $_FILES['empImage']['error'] === UPLOAD_ERR_OK) {
        // Get the file contents
        $imageData = file_get_contents($_FILES['empImage']['tmp_name']);
        //$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $imageData =  base64_encode($imageData);

        // Select employee details from 'employees' table
        $sqlSelect = "SELECT emp_id, name FROM employees WHERE emp_id = '$employeeId'";
        $resultSelect = $conn->query($sqlSelect);

        if ($resultSelect->num_rows > 0) {
            session_start();
            $set_val = $resultSelect->fetch_assoc();
            $_SESSION['emp_id'] = $set_val['emp_id'];
            // $_SESSION['type'] = $set_val['employee_type'];
            $_SESSION['employee'] = $set_val['name'];

            // $sqlInsert = "INSERT INTO employeelogins (emp_id, emp_image, emp_location) VALUES ('$employeeId', ?, ?)";
            // $stmt = $conn->prepare($sqlInsert);

            // Bind parameters
            // echo $imageData;
            // $stmt->bind_param('ss', $imageData, $emp_location);

            $sqlInsert = "INSERT INTO employeelogins (emp_id, emp_image, emp_location) VALUES ('$employeeId', '$imageData', '$emp_location')";
            $stmt = $conn->prepare($sqlInsert);
            
            // Execute the statement
            if ($stmt->execute()) {
                $response = array(
                    'success' => true,
                    'message' => 'Login successful:-' . $employeeId,
                    'emp_image' => 'Image uploaded successfully',
                    'emp_location' => 'location Uploaded Succesfully'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error inserting data into employeelogins: ' . $stmt->error
                );
            }

            // Close the statement
            $stmt->close();
        } else {
            $response = array(
                'success' => false,
                'message' => 'Invalid employee ID'
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'No file uploaded or file upload error'
        );
    }

    // Return the JSON response
    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}
?>

