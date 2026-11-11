<?php
include 'formconnection.php';



try {
    $employeeId = $_POST['employeeId'];
    $emp_location = $_POST['emp_location'];

    list($latitude, $longitude) = explode(',', $emp_location);

    if (isset($_FILES['empImage']) && $_FILES['empImage']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['empImage']['tmp_name']);
        $imageData = base64_encode($imageData);

        // ✅ Fetch department_name along with emp_id
        $sqlSelect = "SELECT emp_id,  name, department_name FROM employees WHERE emp_id = '$employeeId'";
        $resultSelect = $conn->query($sqlSelect);

        if ($resultSelect->num_rows > 0) {
            session_start();
            $set_val = $resultSelect->fetch_assoc();

            $_SESSION['emp_id'] = $set_val['emp_id'];
            // $_SESSION['type'] = $set_val['employee_type'];
            $_SESSION['employee'] = $set_val['name'];
            $_SESSION['department_name'] = $set_val['department_name'];

            // ✅ Insert image and location into `employeelogins` table
            $sqlInsert = "INSERT INTO employeelogins (emp_id, emp_image, emp_location) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sqlInsert);
            $stmt->bind_param('sss', $employeeId, $imageData, $emp_location);

            if ($stmt->execute()) {
                $response = array(
                    'success' => true,
                    'message' => 'Login successful',
                    'department_name' => $set_val['department_name'],  // ✅ Send department name in response
                    'emp_image' => 'Image uploaded successfully',
                    'emp_location' => 'Location uploaded successfully'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error inserting data into employeelogins: ' . $stmt->error
                );
            }

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

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}
?>
