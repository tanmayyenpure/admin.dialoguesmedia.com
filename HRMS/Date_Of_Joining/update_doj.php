<?php
include '../formconnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Assuming that 'DOJ_ID' is an auto-incremented primary key
        $id = $_POST['id'];
        $name = $_POST['name'];
        $value = $_POST['value'];

        $sql = "UPDATE `dateofjoining` SET `$name` = '$value' WHERE `DOJ_ID` = $id";

        if ($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'Record updated successfully!';
        } else {
            throw new Exception('Error: ' . $sql . '<br>' . $conn->error);
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Caught exception: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


<!-- ./Date_Of_Joining/read_doj.php -->

<?php
require '../formconnection.php';

try {
    $sql = "SELECT * FROM dateofjoining";
    $result = mysqli_query($conn, $sql);  
    $dojs = null;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($result->num_rows == 1) {
            $dojs[] = $result->fetch_assoc();
        }
        else
        {
            $dojs = array();
            while ($row = $result->fetch_assoc()) {
            
                $dojs[] = $row;
            }
        }
    }

    $response = array('status' => 'success', 'data' => $dojs);
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
}

$conn->close();
?>


<!-- ./Date_Of_Joining/create_doj.php -->

<?php
include '../formconnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'];
        $college = $_POST['college'];
        $location = $_POST['location'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $department = $_POST['department'];
        $doj = $_POST['doj'];
        $duration = $_POST['duration'];
        $ejm = (int)$_POST['ejm'];
        $ol = (int)$_POST['ol'];
        $is_employee = (int)$_POST['is_employee'];
        $sod = (int)$_POST['sod'];
        $video = (int)$_POST['video'];
        $review = (int)$_POST['review'];
        $feedback_form = (int)$_POST['feedback_form'];
        $certificate = (int)$_POST['certificate'];
        $recommendation_letter = (int)$_POST['recommendation_letter'];
        $app_letter = (int)$_POST['app_letter'];
        $batch = $_POST['batch'];
        $tpo = $_POST['tpo'];
        $tpo_contact = $_POST['tpo_contact'];
        $tpo_email = $_POST['tpo_email'];

        $sql = "insert into `dateofjoining`(`name`, `college`, `location`, `email`, `mobile`, `department`, `doj`, `duration`, `ejm`, `ol`, `is_employee`, `sod`, `video`, `review`, `feedback_form`, `certificate`, `recommendation_letter`, `app_letter`, `batch`, `tpo`, `tpo_contact`, `tpo_email`) 
                values ('$name', '$college', '$location', '$email', '$mobile', '$department', '$doj', '$duration', $ejm, $ol, $is_employee, $sod, $video, $review, $feedback_form, $certificate, $recommendation_letter, $app_letter, '$batch', '$tpo', '$tpo_contact', '$tpo_email')";

        if ($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'DOJ  added successfully!';
            $response['DOJ_ID'] = $conn->insert_id; // Retrieve the auto-generated DOJ_ID
        } else {
            throw new Exception('Error: ' . $sql . '<br>' . $conn->error);
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Caught exception: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
