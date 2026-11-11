<?php
include '../formconnection.php'; // Include database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Prepare and sanitize input values
        $name = $conn->real_escape_string($_POST['name']);
        $college = $conn->real_escape_string($_POST['college']);
        $location = $conn->real_escape_string($_POST['location']);
        $email = $conn->real_escape_string($_POST['email']);
        $mobile = $conn->real_escape_string($_POST['mobile']);
        $department = $conn->real_escape_string($_POST['department']);
        $doj = $conn->real_escape_string($_POST['doj']);
        $duration = $conn->real_escape_string($_POST['duration']);
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
        $batch = (int)$_POST['batch']; // Ensure this is treated as an integer
        $tpo = $conn->real_escape_string($_POST['tpo']);
        $tpo_contact = $conn->real_escape_string($_POST['tpo_contact']);
        $tpo_email = $conn->real_escape_string($_POST['tpo_email']);

        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO dateofjoining 
                (name, college, location, email, mobile, department, doj, duration, ejm, ol, is_employee, sod, video, review, feedback_form, certificate, recommendation_letter, app_letter, batch, tpo, tpo_contact, tpo_email) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssiiiiiiiiiiiiss",
            $name,
            $college,
            $location,
            $email,
            $mobile,
            $department,
            $doj,
            $duration,
            $ejm,
            $ol,
            $is_employee,
            $sod,
            $video,
            $review,
            $feedback_form,
            $certificate,
            $recommendation_letter,
            $app_letter,
            $batch,
            $tpo,
            $tpo_contact,
            $tpo_email
        );

        if ($stmt->execute()) {
            $response = [
                'status' => 'success',
                'message' => 'DOJ added successfully!',
            ];
        } else {
            throw new Exception('Error: ' . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => 'Caught exception: ' . $e->getMessage(),
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
