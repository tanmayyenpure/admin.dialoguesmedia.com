<?php

session_start();

include '../formconnection.php';


if (isset($_GET['submit'])) {
  require 'invitation.php';
}

// if (!isset($_SESSION['emp_id'])) {
//   echo "<script>console.log('Emp id not given');</script>";s
//   header("location:/OurProject/login.html");
// } else {
  $emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : null;
  $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
  $media_id = isset($_GET['media_id']) ? $_GET['media_id'] : null;
   $id = isset($_GET['id']) ? $_GET['id'] : 'create';

  /// trial raj
if($project_id!=null)     {
  $sql = "SELECT * FROM project WHERE pid = '$project_id'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Output data of the single row
    $row = $result->fetch_assoc();
} 
}
if($media_id!=null) {
  $sql = "SELECT * FROM media WHERE id = '$media_id'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Output data of the single row
    $media = $result->fetch_assoc();
} 
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Details Form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/kannjiba1.css?ver=4">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="min-height:100vh">
  <?php
  $err = "";
  $ses = "";
  $buttonText = "Verify";
  $inputPlaceholder = "Mobile number";
  $mobileNumber = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit-otp'])) {
      $input = $_POST['num'];
  
      if (!preg_match('/^[0-9]{10}$/', $input) && !preg_match('/^[0-9]{6}$/', $input)) {
        $err = "Invalid input. Please enter a 10-digit mobile number or a 6-digit OTP.";
      } else {
        if (preg_match('/^[0-9]{6}$/', $input)) {
          // If 6 digits are entered, consider it as OTP verification
          $verotp = $input;
          $stored_otp = $_SESSION['otp'];
  
          if ($verotp == $stored_otp) {
            $ses = "Verified successfully";
            $mobileNumber = $_SESSION['mobile_number'];
            // Clear the OTP and mobile number sessions after successful verification
            unset($_SESSION['otp']);
            unset($_SESSION['mobile_number']);
            $buttonText = "Verified";
            $inputPlaceholder = "Verified Mobile Number";
          } else {
            $err = "Incorrect OTP. Verification failed.";
          }
        } else {
          // If 10 digits are entered, consider it as sending OTP
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
  
          curl_setopt_array($curl, array(
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
            $data = json_decode($response, true);
  
            if (isset($data['return']) && $data['return'] === true) {
              $ses = "Your OTP is sent successfully";
              $buttonText = "Verify OTP";
              $inputPlaceholder = "Enter OTP";
            } else {
              $err = "Otp Not Sent: " . $data['message'];
            }
          }
          curl_close($curl);
        }
      }
    }
  }
  ?>

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <a hresf="#" class="nav-link">Search here</a>


      <form action="#" method="post">
        <div class="form-input">
          <input type="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
      </form>
    </nav>

  </section>
  <!-- CONTENT -->
  <!-- <script src="script.js"></script> -->
  <script src="https://smtpjs.com/v3/smtp.js"></script>
  <main>
    <!-- SIDEBAR -->
    <section id="sidebar">
      <a href="#" class="brand">
        <img src="../img/logo3.jpeg" alt="">
        <span class="text">DialoguesMedia</span>
      </a>
      <ul class="side-menu top">
        <li class="active">
          <a href="dash.php">
            <i class='bx bxs-dashboard' style="width: 2px" ;></i>

            <span class="text">Blank Form</span>
          </a>
        </li>
        <li>
          <a
            href="../MarketType/MarkTypeListing.php?emp_id=<?php echo $emp_id; ?>&Type=1&project_id=<?php echo $project_id; ?>">
            <i class='bx bxs-doughnut-chart'></i>
            <span class="text">
              Save Form
            </span>
          </a>
        </li>
        <li>
          <a
            href="../MarketType/MarkTypeListing.php?emp_id=<?php echo $emp_id; ?>&Type=2&project_id=<?php echo $project_id; ?>">
            <i class='bx bxs-doughnut-chart'></i>
            <span class="text">Submit Form</span>
          </a>
        </li>
      </ul>
      <ul class="side-menu">
      </ul>
    </section>
    <!-- SIDEBAR -->

    <div class="pdf">
       <img class="lgr" src="../<?php echo htmlspecialchars($row["image_path"]); ?>" style="width:100%; height: 100%;">
      <!-- <embed src="../css/null-img.jpg" type="image/jpg" style="width:100%; height: 100%;" /> -->
    </div>
    <div class="kkkkk">
      <form id="RegisterForm" action="" method="post" id="otpForm" enctype="multipart/form-data">
        <div class="container" style="border: 6px solid #c21919; padding: 5px;">
          <div class="image">
            <div class="form-box">
              <div class="form">

                <h1 id="divTAReviews1">Register here</h1>

                <div class="logo">
                  <div class="pertional">
                    <h5>
                      PERSONAL INVITATION
                    </h5>

                  </div>
                  <!-- Main THING -->

                  <div class="im" style="margin-top: 10px;">
                    <div>
                    <a href="https://dialoguesmedia.com">
                        <img class="" src="../<?php echo htmlspecialchars($row["logo_path"]); ?>" height="40">
                      </a>
                    
                    </div>
                    <!-- <div class="vertical"></div> -->

                    <div class="mark">Marketing<br>Partner <br> </div>


                    <div>
                    <img class = "lgr" src ="../img/logo3.jpeg">
                    </div>
                  </div>


                  <div class="dateing">

                    <div class="bb">
                    <h4><?php $date = new DateTime($row["start_date"]);echo $date->format("d");?> - <?php $date = new DateTime($row["end_date"]);echo $date->format("d F");?> | <?php echo htmlspecialchars($row["place"]); ?> <br>
                     <?php echo htmlspecialchars($row["city"]);?> - <?php  echo htmlspecialchars($row["pincode"]); ?> <?php  echo htmlspecialchars($row["country"]); ?><br>
                    </h4>
                    </div>

                    <div class="gg">
                      <h5>INVITATION FORM</h5>
                    </div>

                  </div>

                  <div class="forms">
                    <div class="input-box">
                      <i class="fa-solid fa-signature marginleft"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="Fullname" id="Fullname" placeholder="Full Name">
                    </div>
                    <input type="hidden" name="Id" id="Id" placeholder="Id" value="<?php echo $_GET["project_id"];?> ">
                    <div class="input-box">
                      <i class="fa-solid fa-user"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="Designation" id="Designation" placeholder="Designation">
                    </div>
                    <div class="input-box">
                      <!--<i class="fa-solid fa-building"></i>-->
                      <i class="fa-solid fa-building"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="Comp" id="Comp" placeholder="Company">
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-address-book"></i>
                      <!--<i class="fa-regular fa-address-book"></i>-->
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="Add" id="Add" placeholder="Address">
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-mobile-retro"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input style="margin-left: 15px;" type="text" id="num" placeholder="Mobile" name="num"
                        class="form-control" value="">
                      <button class="button" name="submit-opt" id="submit-otp" >
                        <div class="top" >Mobile</div>
                      </button>
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-envelope"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="email" name="emailadd" id="emailadd" placeholder="Email Address">
                      <button class="button">
                        <div class="top" id="email-btn">Email</div>
                      </button>
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-city"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="city" id="city" placeholder="City">
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-house"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="state" id="state" placeholder="State">
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-mobile"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="text" name="Pincode" id="Pincode" placeholder="Pin Code">
                    </div>
                    <div class="input-box">
                      <i class="fa-solid fa-calendar-days"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <div class="da" style="display: flex; justify-content: end;">
                        <div class="d">
                          Visiting Date:
                          <select id="select_day" name="select_day" style="border: none;margin-left: 15px;">
                            <option value="">DD</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                          </select>
                          <select id="select_month" name="select_month" style="border: none;">
                            <option value="">MM</option>
                            <option value=" 01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>

                          <select id="select_year" name="select_year" style="border: none;">
                            <option value="">YY</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2024">2025</option>
                            <option value="2024">2026</option>

                          </select>
                        </div>
                      </div>

                    </div>

                    <div class="input-box">
                      <i class="fa-solid fa-calendar-days"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <input type="number" name="visitors" id="visitors" required placeholder="Add On Visitor">
                    </div>
                    <div class="input-box" style="border-bottom: none; margin-top:10px;">
                      <i class="fa-solid fa-list"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <div class="d">
                        <span for="" style="width: 402px;">Exhibitors list:</span>
                        <input style="margin: 4px; padding: 0;" type="radio" id="ExLstReq" name="ExLstReq"
                          value="YES" />Yes
                        <input style="margin: 4px; padding: 0;" type="radio" id="ExLstReq" name="ExLstReq"
                          value="NO" />No
                      </div>
                    </div>
                    <div class="input-box" style="border-bottom: none; margin-top: 10px;">
                      <i class="fa-solid fa-list"></i>
                      <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                      <div class="d">
                        <span for="" style="width:402px;">
                          Exhibtior Appointment:
                        </span>
                        <!--<span>Yes</span>-->
                        <input style="margin:4px; padding:0px;  " type="radio" id="html1" name="html1" value="YES">Yes
                        <!--<span>No</span>-->
                        <input style="margin:4px; padding: 0;" type="radio" id="html1" name="html1" font-size="12"
                          value="NO">No
                      </div>
                    </div>
                    <div style="position:relative;">
                      <div class="input-box">
                        <i class="fa-solid fa-location-dot" style="margin-left: -41px;"></i>

                        <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                        <input type="text" id="location" placeholder="location" name="location" readonly disabled>
                      </div>
                      <div class="location">
                        <a href="javascript:marklocation()">
                          <div id="location-btn">Locate</div>
                        </a>
                      </div>
                    </div>
                    <div class="controller">
                      <div id="snap">
                        Take Picture
                      </div>
                      <div id="reset" onclick="resetCapture()">
                        Reset Cam
                      </div>
                      <div id="switchCam" style="margin-bottom: 10px; padding: 7px 10px; font-size: 14px; background: #8e0c0c; color: white; border-radius: 10px; display: inline-block; cursor: pointer;">
                        Switch Cam
                      </div>
                      <div class="video-canvas">
                        <div class="video wrap">
                          <video id="video" playsinline autoplay></video>
                        </div>

                        <div class="canvas-rap">

                          <!-- <canvas id="canvas1" width="100" height="100" style="display: none;"></canvas> -->
                        </div>
                      </div>
                      <div class="input-box">
                        <i class="fa-solid fa-comment fa-rotate-270"></i>
                        <!--<i class="fa-solid fa-signature"></i>-->
                        <img class="circle" src="../img/Dual Ring-1s-200px.png" alt="">
                        <input type="text" name="feedback" id="feedback" required placeholder="Add your feedback">
                      </div>
                    </div>
                    <div class="sub-btn">
                      <!-- Save button -->
                      
                      <button class="input-save" type="button"
                        onclick="uploadAndSubmitForm(1,<?php echo $_GET['project_id']; ?>)">Save</button>
                      <!-- Submit button -->
                      <button type="button" name="sbt-btn" class="input-sub"
                        onclick="uploadAndSubmitForm(2,<?php echo $_GET['project_id']; ?>)">Submit</button>
                    </div>
                  </div>
                  <div>
                  </div>
                </div>
              </div>
            </div>
      </form>
    </div>
  </main>
</body>

<!-- script for mobile otp verification  -->
<script>

 var mobile_verify=false;
  let verify_btn = document.getElementById('submit-otp');
  let input_val = document.getElementById('num');


  verify_btn.addEventListener('click', (e) => {
    e.preventDefault()
    console.log(verify_btn.firstElementChild.innerHTML);
    if (verify_btn.firstElementChild.innerHTML === 'Mobile') 
  {
      var mobile = input_val.value;
      $.ajax({
        url: "mobile_otp_verify.php",
        type: "post",
        data: {
          work: 'send_otp',
          input_val: input_val.value
        },
        success: function (data) {
          let All_data = JSON.parse(data)
          // console.log(All_data);
          if (All_data.return == 'err') {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Invalid input. Please enter a 10-digit mobile number "
            });
          } else if (All_data.return == true) {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: All_data.message
            });
            input_val.placeholder = "Enter OTP";
            input_val.value = "";
            verify_btn.firstElementChild.innerHTML = "Verify OTP"
            verify_btn.classList.add('verify_btn')


            document.querySelector('.verify_btn').addEventListener('click', () => {
              $.ajax({
                url: "mobile_otp_verify.php",
                type: "post",
                data: {
                  work: 'verify_otp',
                  input_val: input_val.value
                },
                success: function (data) {
                  if (data == 'err') {
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "Invalid input. Please enter a 6 Digit OTP "
                    });
                  } else if (data) {
                    Swal.fire({
                      icon: "success",
                      title: "Success",
                      text: 'OTP Verification Successfull'
                    })
                    mobile_verify=true
                    verify_btn.classList.remove('verify_btn')
                    verify_btn.firstElementChild.innerHTML = 'verified';
                    verify_btn.firstElementChild.style.backgroundColor = "#32a852"
                    input_val.value = mobile;
                    verify_btn.style.pointerEvents = "none"
                    input_val.setAttribute('readonly', true);


                  } else {
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "Incorrect OTP. Verification failed."
                    });
                    input_val.value = "";
                  }

                }
              })
            })



          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: All_data.message
            });
            input_val.value = "";
          }

        }
      })

    }
  })

</script>




<!-- new email -->

<script>
  var email_verify=false;
  var enteredEmail = ''; // Variable to store the entered email
  var otp_val = '';

  var emailInput = document.getElementById('emailadd');
  var otpBtn = document.getElementById('email-btn');
  otpBtn.addEventListener('click', (e) => {
    e.preventDefault()

    // Check if the input contains "@" to determine if it's an email or OTP
    if (emailInput.value != "" && e.target.id == "email-btn") {
      // If it's an email, send OTP
      otp_val = Math.floor(Math.random() * 1000000);
      enteredEmail = emailInput.value;
      otpBtn.innerHTML = 'sending..'
      let emailbody = `<h2>Your OTP is </h2>${otp_val}`;
      Email.send({
        SecureToken: "85c1ccce-8416-4cd1-a411-05ec6507b192",
        To: emailInput.value,
        From: "dialoguesmediamktg11@gmail.com",
        Subject: "Email OTP for Verification",
        Body: emailbody,
      }).then(message => {
        if (message === "OK") {
          // console.log(otp_val);

          // Save the entered email and hide the placeholder for OTP
          enteredEmail = emailInput.value;
          emailInput.type = 'text'
          otpBtn.innerHTML = 'verify Otp'
          emailInput.placeholder = "Enter OTP...";
          emailInput.value = "";
          otpBtn.classList.add('verify_email')
          otpBtn.removeAttribute('id', "email-btn");
          // Clear the email input
          // emailInput.addEventListener('input', handleInput);

          Swal.fire({
            icon: "success",
            title: "Success",
            text: "OTP sent to your email. Check your spam folder too!.."
          });
          otpBtn.innerHTML = 'verify'
          otpBtn = document.querySelector('.verify_email');
          otpBtn.addEventListener('click', (e) => {


            e.preventDefault()
            // console.log(e);
            otpBtn.classList.remove('verify_email')
            otpBtn.id = "email-btn";
            if (emailInput.value == otp_val) {
              emailInput = document.getElementById('emailadd');
              otpBtn = document.getElementById('email-btn');

              // Display the entered email in the input field
              emailInput.value = enteredEmail;

              // Change the button text to indicate verification

              email_verify=true;
              otpBtn.style.pointerEvents = "none"
              otpBtn.innerHTML = "Verified";
              otpBtn.setAttribute('disabled', true)
              otpBtn.style.backgroundColor = "#32a852";
              otpBtn.parentElement.style.pointerEvents = "none"
              // Disable the input and the verify button after successful verification
              emailInput.type = "email";

              emailInput.setAttribute('readonly', true)



              // Display an alert message for successful OTP verification

              Swal.fire({
                icon: "success",
                title: "SUCCESS",
                text: "Email address verified!"
                // });


              })

            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Enterd a wrong email"
              });
              emailInput.val = ""
            }
          })
          // alert("OTP sent to your email. Check your spam folder too!..");
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Failed to send OTP. Please try again."
          });
          // alert("Failed to send OTP. Please try again.");
        }
      }

      );
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Enter a Valid Mail"
      });
    }

  })


  // function handleInput() {
  //   // Disable input while the OTP is not sent
  //   document.getElementById('email').removeEventListener('input', handleInput);
  // }
</script>

<script>
    const video = document.getElementById('video');
    const snap = document.getElementById('snap');
    const errorMsgElement = document.getElementById('ErrorMsg');
    const switchCam = document.getElementById('switchCam');
    let captureMode = 0; // 0: Camera not open, 1: Camera open, 2: Photo captured
    let useFrontCamera = false; // Default to back camera

    snap.addEventListener('click', () => {
      if (captureMode === 0) {
        // First click opens the camera
        openCamera();
      } else if (captureMode === 1) {
        // Second click captures the photo
        capturePhoto(captureMode);
        captureMode = 2;
      } else if (captureMode === 2) {
        // Third click captures another photo
        capturePhoto(captureMode);
        captureMode = 1;
      }
    });

    switchCam.addEventListener('click', () => {
      useFrontCamera = !useFrontCamera;
      openCamera();
    });

    function openCamera() {
      const constraints = {
        audio: false,
        video: {
          width: 220,
          height: 160,
          facingMode: useFrontCamera ? 'user' : 'environment'
        }
      };

      async function init() {
        try {
          const stream = await navigator.mediaDevices.getUserMedia(constraints);
          handleSuccess(stream);
          captureMode = 1;
          snap.textContent = 'Capture Photo';
        } catch (e) {
          errorMsgElement.innerHTML = `navigator.getUserMedia.error: ${e.toString()}`;
        }
      }
      init();
    }

    function handleSuccess(stream) {
      window.stream = stream;
      video.srcObject = stream;
    }

    const canvasRap = document.getElementsByClassName('canvas-rap')[0];

    function capturePhoto(id) {
      let canvas = document.createElement('canvas');
      canvas.width = 100;
      canvas.height = 100;
      const context = canvas.getContext('2d');
      context.drawImage(video, 0, 0, 100, 100);
      canvas.id = 'canvas' + id;
      canvasRap.append(canvas);
    }

    function resetCapture() {
      captureMode = 1;
      canvasRap.innerHTML = '';
    }

  function changeContent() {
    var d = new Date();
    document.getElementById('year').options[0].text = d.getFullYear();
    document.getElementById('month').options[0].text = (d.getMonth() + 1);
    document.getElementById('days').options[0].text = d.getDate();
  }



  function marklocation() {
    // Check if Geolocation is supported
    if ('geolocation' in navigator) {
      let location_btn = document.getElementById('location-btn');
      location_btn.innerHTML = 'Locating...'
      navigator.geolocation.getCurrentPosition(function (position) {
        // Get latitude and longitude
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // Set the location input field value
        document.getElementById('location').value = `${latitude},${longitude}`;
        // alert('Location Set Successfully :- ' + `${latitude},${longitude}`);

        location_btn.innerHTML = 'Located';
        location_btn.style.backgroundColor = "#32a852"
      }, function (error) {
        console.error('Error getting location:', error.message);
        alert('Error getting location. Please try again.');
      });
    } else {
      alert('Geolocation is not supported in your browser.');
    }
  }
</script>



<script>
 function uploadPhoto() {
  return new Promise((resolve, reject) => {
    // Get the canvas element and its 2d context
    const canvas1 = document.getElementById('canvas1');
    const context = canvas1.getContext('2d');

    // Get the image data from the canvas
    const imageData = context.getImageData(0, 0, canvas1.width, canvas1.height);

    // Create a new canvas element to draw the image data
    const tempCanvas = document.createElement('canvas');
    const tempContext = tempCanvas.getContext('2d');
    tempCanvas.width = canvas1.width;
    tempCanvas.height = canvas1.height;
    tempContext.putImageData(imageData, 0, 0);

    // Convert the canvas content to a Blob
    tempCanvas.toBlob(blob => {
      if (blob) {
        resolve(blob);
      } else {
        reject(new Error('Unable to convert canvas to Blob.'));
      }
    }, 'image/jpeg', 0.95); // Specify the desired image format and quality (0 to 1)
  });
}


  function sendHtmlEmail(media_id) {

    const emailInput = document.getElementById('emailadd');

    // Check if the input contains "@" to determine if it's an email
    if (emailInput.value.includes('@')) {
      // HTML template content
      let emailBody = `<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">

    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">


    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu:ital,wght@0,400;0,700;1,400;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu:ital,wght@0,400;0,700;1,400;1,700&display=swap">

    <style type="text/css">
        @import url(https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu:ital,wght@0,400;0,700;1,400;1,700&display=swap);
    </style>

    <style>
         :root {
            color-scheme: light;
        }
        
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            overflow-wrap: break-word;
            -ms-word-break: break-all;
            -ms-word-break: break-word;
            word-break: break-all;
            word-break: break-word;
        }
        
        ul,
        ol {
            padding: 0;
            margin-top: 0;
            margin-bottom: 0;
        }
        
        li {
            margin-bottom: 0;
        }
        
        .list-block-list-outside-left li {
            margin-left: 20px !important;
        }
        
        .list-block-list-outside-right li {
            margin-right: 20px !important;
        }
        
        .paragraph {
            font-size: 15px;
            font-family: Open Sans, sans-serif;
            font-weight: normal;
            font-style: normal;
            text-align: start;
            line-height: 1;
            text-decoration: none;
            color: #5f5f5f;
        }
        
        .heading1 {
            font-size: 32px;
            font-family: Open Sans, sans-serif;
            font-weight: normal;
            font-style: normal;
            text-align: start;
            line-height: 1;
            text-decoration: none;
            color: #000000;
        }
        
        .heading2 {
            font-size: 26px;
            font-family: Open Sans, sans-serif;
            font-weight: normal;
            font-style: normal;
            text-align: start;
            line-height: 1;
            text-decoration: none;
            color: #000000;
        }
        
        .heading3 {
            font-size: 19px;
            font-family: Open Sans, sans-serif;
            font-weight: normal;
            font-style: normal;
            text-align: start;
            line-height: 1;
            text-decoration: none;
            color: #000000;
        }
        
        .list {
            font-size: 15px;
            font-family: Open Sans, sans-serif;
            font-weight: normal;
            font-style: normal;
            text-align: start;
            line-height: 1;
            text-decoration: none;
            color: #5f5f5f;
        }
        
        p a,
        li a {
            display: inline-block;
            color: #5457FF;
            text-decoration: none;
            font-style: normal;
            font-weight: normal;
        }
        
        .button-table a {
            text-decoration: none;
            font-style: normal;
            font-weight: normal;
        }
        
        .paragraph>span {
            text-decoration: none;
        }
        
        .heading1>span {
            text-decoration: none;
        }
        
        .heading2>span {
            text-decoration: none;
        }
        
        .heading3>span {
            text-decoration: none;
        }
        
        .list>span {
            text-decoration: none;
        }
        
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }
        
        #MessageViewBody,
        #MessageWebViewDiv {
            width: 100% !important;
        }
        
        table {
            border-collapse: collapse;
            border-spacing: 0;
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        
        table:not(.button-table) {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        
        th {
            font-weight: normal;
        }
        
        tr td p {
            margin: 0;
        }
        
        img {
            -ms-interpolation-mode: bicubic;
        }
        
        a[x-apple-data-detectors],
        .unstyle-auto-detected-links a,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        
        .im {
            color: inherit !important;
        }
        
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        
        img.g-img+div {
            display: none !important;
        }
        
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .contentMainTable {
                min-width: 320px !important;
            }
        }
        
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .contentMainTable {
                min-width: 375px !important;
            }
        }
        
        @media only screen and (min-device-width: 414px) {
            u~div .contentMainTable {
                min-width: 414px !important;
            }
        }
    </style>

    <style>
        @media only screen and (max-device-width: 640px) {
            .contentMainTable {
                width: 100% !important;
                margin: auto !important;
            }
            .single-column {
                width: 100% !important;
                margin: auto !important;
            }
            .multi-column {
                width: 100% !important;
                margin: auto !important;
            }
            .imageBlockWrapper {
                width: 100% !important;
                margin: auto !important;
            }
        }
        
        @media only screen and (max-width: 640px) {
            .contentMainTable {
                width: 100% !important;
                margin: auto !important;
            }
            .single-column {
                width: 100% !important;
                margin: auto !important;
            }
            .multi-column {
                width: 100% !important;
                margin: auto !important;
            }
            .imageBlockWrapper {
                width: 100% !important;
                margin: auto !important;
            }
        }
    </style>
    <style>
        .list-block-outlook-outside-left {
            margin-left: -18px;
        }
        
        .list-block-outlook-outside-right {
            margin-right: -18px;
        }
        
        a:link,
        span.MsoHyperlink {
            mso-style-priority: 99;
            display: inline-block;
            color: #5457FF;
            text-decoration: none;
            font-style: normal;
            font-weight: normal;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #F5F6F8;">
    <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: #F5F6F8;">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="640" style="margin: auto;" class="contentMainTable">
            <tr class="wp-block-editor-spacerblock-v1">
                <td style="background-color:#F5F6F8;line-height:50px;font-size:50px;width:100%;min-width:100%">&nbsp;
                </td>
            </tr>
            <tr class="wp-block-editor-headingblock-v1">
                <td valign="top" style="background-color:#ffffff;display:block;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px;text-align:center">
                    <p style="font-family:Ubuntu, sans-serif;text-align:center;line-height:NaNpx;letter-spacing:0;font-size:33px;background-color:#ffffff;color:#000000;margin:0;word-break:normal" class="heading1"><span style="color:#00308F"><span style="font-weight: bold" class="bold"><span
                           style="font-style: italic" class="italic"> <?php echo $row["Description"]; ?> </span></span>
                        </span><br><span style="color:#00308F"><span style="font-weight: bold"
                        class="bold"><span style="font-style: italic" class="italic">INVITATION</span></span>
                        </span>
                    </p>
                </td>
            </tr>
            <tr class="wp-block-editor-headingblock-v1">
                <td valign="top" style="background-color:#ffffff;display:block;padding-top:9px;padding-right:9px;padding-bottom:9px;padding-left:9px;text-align:right">
                    <p style="font-family:Open Sans, sans-serif;text-align:right;line-height:NaNpx;letter-spacing:0;font-size:19px;background-color:#ffffff;color:#000000;margin:0;word-break:normal" class="heading3"><span style="font-weight: bold" class="bold"><span style="font-style: italic"
                        class="italic" style="color:#00308F"> </span></span><span style="display: inline-block;text-decoration: underline" class="underline"><span style="font-weight: bold" class="bold"><span style="font-style: italic"
                           class="italic"><?php $date = new DateTime($row["start_date"]);echo $date->format("F, Y"); ?>
 </span></span>
                        </span><span style="font-weight: bold" class="bold"><span style="font-style: italic" class="italic"> </span></span>
                    </p>
                </td>
            </tr>
            <tr class="wp-block-editor-imageblock-v1">
                <td style="background-color:#ffffff;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0" align="center">
                    <table align="center" width="640" class="imageBlockWrapper" style="width:640px" role="presentation">
                        <tbody>
                            <tr>
                            <?php
// // Step 1: Generate or load the image
$imagePath = $row['image_path']; // Replace with your image path
// $imageData = file_get_contents($imagePath);
// $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);

// // Step 2: Convert the image to Base64
// $base64Image = base64_encode($imageData);

                      echo '<td style="padding:0"><img src="http://localhost/OurProject/forms/uploads/null-img.jpg" alt="null-img"  width="640" height="" style="border-radius:0px;display:block;height:auto;width:100%;max-width:100%;border:0" class="g-img" border="0" /></td>';
                              ?>
                     </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="wp-block-editor-headingblock-v1">
                <td valign="top" style="background-color:#ffffff;display:block;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:center">
                    <p style="font-family:Open Sans, sans-serif;text-align:center;line-height:NaNpx;letter-spacing:0;font-size:32px;background-color:#ffffff;color:#000000;margin:0;word-break:normal" class="heading1"><span style="font-weight: bold" class="bold">Get The Invitation</span> <span style="font-weight: bold" class="bold">Pass</span></p>
                </td>
            </tr>
            <tr class="wp-block-editor-paragraphblock-v1">
                <td valign="top" style="padding:20px 20px 20px 20px;background-color:#ffffff">
                    <p class="paragraph" style="font-family:Open Sans, sans-serif;text-align:center;line-height:NaNpx;font-size:15px;margin:0;color:#5f5f5f;letter-spacing:0;word-break:normal">
                        Click on the button </p>
                </td>
            </tr>
            <tr class="wp-block-editor-buttonblock-v1" align="center">
                <td style="background-color:#ffffff;padding-top:22px;padding-right:22px;padding-bottom:22px;padding-left:22px;width:100%" valign="top">
                    <table role="presentation" cellspacing="0" cellpadding="0" class="button-table">
                        <tbody>
                            <tr>
                                <td valign="top" class="button-td button-td-primary" style="cursor:pointer;border:none;border-radius:4px;background-color:#8B2066;font-size:16px;font-family:Open Sans, sans-serif;width:fit-content;letter-spacing:0;color:#fdfcfc">
                                    <a style="color:#fdfcfc" href="http://localhost/OurProject/Forms/index.php?submit=1&media_id=`+media_id.toString()+`&project_id=<?php echo $project_id; ?>">
                                        <table role="presentation">

                                            <tbody>
                                                <tr>
                                                    <!-- Top padding -->
                                                    <td valign="top" colspan="3" height="16" style="height: 16px; line-height: 1px; padding: 0;">
                                                        <span style="display: inline-block;">&nbsp;</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!-- Left padding -->
                                                    <td valign="top" width="24" style="width: 24px; line-height: 1px; padding: 0;">
                                                        <span style="display: inline-block;">&nbsp;</span>
                                                    </td>
                                                    <!-- Content -->
                                                    <td valign="top" style="
        display: inline-block;
        cursor: pointer; border: none; border-radius: 4px; background-color: #8B2066; font-size: 16; font-family: Open Sans, sans-serif; width: fit-content; font-weight: null; letter-spacing: 0;
          color: #fdfcfc;
          padding: 0;
        ">
                                                        <span style="font-weight: bold" class="bold">DIGITAL INVITATION PASS</span>
                                                    </td>
                                                    <!-- Right padding -->
                                                    <td valign="top" width="24" style="width: 24px; line-height: 1px; padding: 0;">
                                                        <span style="display: inline-block;">&nbsp;</span>
                                                    </td>
                                                </tr>
                                                <!-- Bottom padding -->
                                                <tr>
                                                    <td valign="top" colspan="3" height="16" style="height: 16px; line-height: 1px; padding: 0;">
                                                        <span style="display: inline-block;">&nbsp;</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="wp-block-editor-socialiconsblock-v1" role="article" aria-roledescription="social-icons" style="display:table-row;background-color:#F5F6F8">
                <td style="width:100%">
                    <table style="background-color:#F5F6F8;width:100%;padding-top:42px;padding-bottom:32px;padding-left:32px;padding-right:32px;border-collapse:separate !important" cellpadding="0" cellspacing="0" role="presentation">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <div style="max-width:576px">
                                        <table role="presentation" style="width:100%" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td valign="top">
                                                        <div style="margin-left:auto;margin-right:auto;margin-top:-5px;margin-bottom:-5px;width:100%;max-width:208px">
                                                            <table role="presentation" style="padding-left:184" width="100%" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <table role="presentation" align="left" style="float:left" class="single-social-icon" cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top" style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link" href="https://www.facebook.com/profile.php?id=100063876703085&mibextid=ZbWKwL" target="_blank" rel="noreferrer"><img src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/facebook/facebook-round-solid-color.png" width="32" height="32" style="max-width:32px;display:block;border:0"
                                                                                                    alt="Facebook"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table role="presentation" align="left" style="float:left" class="single-social-icon" cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top" style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link" href="https://twitter.com/DialoguesMedia" target="_blank" rel="noreferrer"><img src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/x/x-round-solid-color.png" width="32" height="32" style="max-width:32px;display:block;border:0"
                                                                                                    alt="X (formerly Twitter)"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table role="presentation" align="left" style="float:left" class="single-social-icon" cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top" style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link" href="https://www.youtube.com/@dialoguesmedia9682" target="_blank" rel="noreferrer"><img src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/youtube/youtube-round-solid-color.png" width="32" height="32" style="max-width:32px;display:block;border:0"
                                                                                                    alt="Youtube"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table role="presentation" align="left" style="float:left" class="single-social-icon" cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top" style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link" href="https://www.instagram.com/dialogues_media?igsh=MXF2bGVubmJudXYzbg==" target="_blank" rel="noreferrer"><img src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/instagram/instagram-round-solid-color.png" width="32" height="32" style="max-width:32px;display:block;border:0"
                                                                                                    alt="Instagram"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>`;
          Attachments:[{
        name: "invitation.pdf",
        path: "https://dialoguesmedia.com/OurProject/temp/invi.pdf"
        // path:"http://localhost/OurProject/temp/invi.pdf"
      }]

      Email.send({
        SecureToken: "85c1ccce-8416-4cd1-a411-05ec6507b192",
        To: emailInput.value,
        From: "dialoguesmediamktg11@gmail.com",
        Subject: "PERSONAL INVITATION <?php echo $row["Description"]; ?> '<?php $date = new DateTime($row["start_date"]);echo $date->format("d");?> - <?php $date = new DateTime($row["end_date"]);echo $date->format("d F");?> | <?php echo htmlspecialchars($row["city"]); ?> ",
        Body: emailBody,
      }).then(message => {
          if (message === "OK") {
            alert("HTML Email sent successfully!");
          } else {
            alert("Failed to send HTML Email. Please try again.");
          }
        }
      );
    }
  }

  function uploadAndSubmitForm(Stype, id) {
     
    uploadPhoto().then(blob => {
  // Get values from the form
  const form = document.getElementById('RegisterForm'); // Add the ID of your form
  const formData = new FormData();

  // Iterate through form elements and append them to formData
  for (const element of form.elements) {
    if (element.type !== 'submit' && element.name) {
      formData.append(element.name, element.value);
    }
  }

  formData.append('language', document.querySelector('input[name="ExLstReq"]:checked').value);
  formData.append('languages', document.querySelector('input[name="html1"]:checked').value);

  // Append the image blob
  formData.append('Image', blob);
  formData.append('Stype', Stype);
  formData.append('Id', id);

  // console.log(blob);

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Configure it: POST-type request to pross-form.php
  xhr.open('POST', 'pross-form.php', true);

  // Set up the callback
  xhr.onreadystatechange = function () {
    // console.log(xhr.readyState);

    // Check if the request is complete
    if (xhr.readyState == 4) {
      // Parse the JSON response
      // console.log(xhr.responseText, xhr.status);
      if (xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
         console.log(response);

        // Check if the form submission was successful
        if (response.status === 'success') {
          sendHtmlEmail(response.media_id);
          alert(response.message);
          window.location.href = 'dashEID1.php?project_id='+id;
          // Additional actions for successful submission
        } else {
          alert('Form submission failed. ' + response.message);
        }
      } else {
        console.error('Error:', xhr.status, xhr.statusText);
      }
    }
  };

  // Send the FormData with the image blob to pross-form.php
  xhr.send(formData);

}).catch(error => {
  console.error('Error:', error.message);
});

 
  }



</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    var id = '<?php echo isset($_GET['media_id']) ? $_GET['media_id'] : ''; ?>';
    // Your form fields
    if (id != '') {
      var fullnameField = $("#Fullname");
      var designationField = $("#Designation");
      var compField = $("#Comp");
      var addField = $("#Add");
      var mobnoField = $("#num");
      var emailField = $("#emailadd");
      var cityField = $("#city");
      var stateField = $("#state");
      var pincodeField = $("#Pincode");
      var selectDayField = $("#select_day");
      var selectMonthField = $("#select_month");
      var selectYearField = $("#select_year");
      var visitorsField = $("#visitors");
      var exListReqField = $("input[name='ExLstReq']");
      var exhibitAppointmentField = $("input[name='html1']");
      var locationField = $("#location");
      var imgField = $(".canvas-rap");
      var feedbackField = $("#feedback");
      
      // // IMAGE

      // const canvasRap = document.getElementsByClassName('canvas-rap')[0];
      // let canvas = document.createElement('canvas');
      // canvas.width = 100;
      // canvas.height = 100;
      // const context = canvas.getContext('2d');
      // context.drawImage(video, 0, 0, 100, 100);
      // canvas.id = 'canvas' + id;
      // canvasRap.append(canvas);
      // // END OF IMAGE
     
      // Fetch data from read-from.php using AJAX
      $.ajax({
        url: 'read-form.php?media_id='+id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          if (data.status === 'success') {
            // Populate form fields with the obtained data
            var formData = data.data; // Accessing the data property
            fullnameField.val(formData.name);
            designationField.val(formData.designation);
            addField.val(formData.address);
            compField.val(formData.company);
            mobnoField.val(formData.mobile);
            emailField.val(formData.email);
            cityField.val(formData.city);
            stateField.val(formData.state);
            pincodeField.val(formData.pincode);

            // Split the date into day, month, and year
            var dateParts = formData.date.split('/');
            selectDayField.val(dateParts[2]);
            selectMonthField.val(dateParts[1]);
            selectYearField.val(dateParts[0]);

            visitorsField.val(formData.visitor);
            exListReqField.filter('[value="' + formData.language + '"]').prop('checked', true);
            exhibitAppointmentField.filter('[value="' + formData.languages + '"]').prop('checked', true);

            // Assuming 'location' is a hidden field, you can set its value
            locationField.val(formData.location);
            console.log(formData.image);
            imgField.append('<img src = "'+ formData.image +'" style =" height:100px !important ; width:100px !important"  >')
            feedbackField.val(formData.feedback);
          } else {
            // Handle error if data retrieval fails
            console.error('Error fetching data: ' + data.message);
          }
        },
        error: function (xhr, status, error) {
          // Handle AJAX error
          console.error('AJAX Error: ' + status + '\n' + error);
        }
      });
    }
  });
</script>

</html>