<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    echo "<script>console.log('Emp id not given');</script>";
    header("location:/OurProject/login.html");
} else {
    $emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : null;
    $project_id = isset($_SESSION['project_id']) ? $_SESSION['project_id'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : 'create';
}

// $stored_otp;

// $err = "";
// $ses = "";
// $buttonText = "Verify";
// $inputPlaceholder = "Mobile number";
// $mobileNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['work'] == 'send_otp') {

    $input = $_POST['input_val'];

    if (!preg_match('/^[0-9]{10}$/', $input) || $input=="" ) {
        $err = ["return"=>"err"];
        echo json_encode($err);


    } else {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['mobile_number'] = $input;
        $mobileNumber = $input;

        $fields = array(
            "variables_values" => $otp,
            "route" => "otp",
            "numbers" => $input,
        );

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                    "authorization: mGIsxVEP0ZFDhR5tvO2fAJHbnSl9r16BTQ3UqiaMpgjYeC8KdNvW6qK4XCuUyAx5jEcJ2dRQBO0sVfGr",  // Replace with your API key
                    "accept: */*",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            )
        );

        $response = curl_exec($curl);

        if ($response === false) {
            $err = "cURL Error: " . curl_error($curl);
        } else {
            // $data = json_decode($response, true);
           echo $response;
            
        }
        curl_close($curl);
    }



} else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['work'] == 'verify_otp') {

    $input=$_POST['input_val'];
    if (!preg_match('/^[0-9]{6}$/', $input) || $input=='') {
        echo 'err';
    } else {
       
        $verotp = $input;
        $stored_otp = $_SESSION['otp'];
        if ($verotp == $stored_otp) {
            // $ses = "Verified successfully";
            // $mobileNumber = $_SESSION['mobile_number'];
            // Clear the OTP and mobile number sessions after successful verification
            unset($_SESSION['otp']);
            unset($_SESSION['mobile_number']);
            // $buttonText = "Verified";
            // $inputPlaceholder = "Verified Mobile Number";
            echo true;
        } else {
            // $err = "Incorrect OTP. Verification failed.";
            echo false;
        }
    }
}

