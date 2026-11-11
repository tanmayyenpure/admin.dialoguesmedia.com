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
//   $emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : null;
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
// Include the PHP QR Code library
include '../phpqrcode/qrlib.php';


// Function to add logo to QR code
function addLogo($qrImagePath, $logoPath, $outputPath) {
    // Load the QR code and the logo images
    $qrImage = imagecreatefrompng($qrImagePath);
    $logoImage = imagecreatefrompng($logoPath);

    // Get dimensions of QR code and logo
    $qrWidth = imagesx($qrImage);
    $qrHeight = imagesy($qrImage);
    $logoWidth = imagesx($logoImage);
    $logoHeight = imagesy($logoImage);

    // Calculate logo size and position
    $logoQrWidth = $qrWidth / 5;
    $scale = $logoWidth / $logoQrWidth;
    $logoQrHeight = $logoHeight / $scale;
    $logoX = ($qrWidth - $logoQrWidth) / 2;
    $logoY = ($qrHeight - $logoQrHeight) / 2;

    // Merge logo and QR code
    imagecopyresampled($qrImage, $logoImage, $logoX, $logoY, 0, 0, $logoQrWidth, $logoQrHeight, $logoWidth, $logoHeight);

    // Save the resulting image
    imagepng($qrImage, $outputPath);

    // Clean up
    imagedestroy($qrImage);
    imagedestroy($logoImage);
}

// Check if data is passed via GET request
if (isset($_GET['media_id'])) {
    // Example data, replace with your actual data retrieval logic
    echo $media["name"];
    $name = $media_id['name']; // Example name
    $designation =$media_id['designation']; // Example designation
    $mobile = $media_id['mobile']; // Example mobile
    $email = $media_id['email']; // Example email

    // Construct data to encode in the QR code
    $data = "Name: $name\nDesignation: $designation\nMobile: $mobile\nEmail: $email\nMedia ID: $sssid";

        // Construct data to encode in the QR code
       

        // Generate QR code
        // $tempDir = 'temp/';
        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }

        $qrImagePath = $tempDir . 'qr.png';
        QRcode::png($data, $qrImagePath, QR_ECLEVEL_H, 10);

        // Path to the logo image
        $logoPath = 'path/to/logo.png'; // Update this with your logo path

        // Path to the output image with logo
        $outputImagePath = $tempDir . 'qr_with_logo.png';

        // Add logo to QR code
        addLogo($qrImagePath, $logoPath, $outputImagePath);

        // Output the QR code with logo
        header('Content-Type: image/png');
        readfile($outputImagePath);

        // Clean up
        unlink($qrImagePath);
        unlink($outputImagePath);
    } else {
        echo 'Media ID not found or invalid.';
    } 

?>
