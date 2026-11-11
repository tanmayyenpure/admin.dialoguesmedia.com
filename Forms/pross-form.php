<?php
  include '../formconnection.php';

  session_start();
  $emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : null;
  $project_id =  $_POST['Id'];
  $FullName = $_POST['Fullname'];
  $Designation = $_POST['Designation'];
  $Company = $_POST['Comp'];
  $Address = $_POST['Add'];
  $MobileNumber = (string) $_POST['num'];
  $EmailAddress = $_POST['emailadd'];

  $City = $_POST['city'];
  $State = $_POST['state'];
  $PinCode = $_POST['Pincode'];

  $Visitingdd = $_POST['select_day'];
  $Visitingmm = $_POST['select_month'];
  $Visitingyy = $_POST['select_year'];
  $VisitDate = $Visitingyy."/".$Visitingmm."/".$Visitingdd;

  $AddOnVisitor = $_POST['visitors'];
  $location = $_POST['location'];
  $Addyourfeedback = $_POST['feedback'];

  $Exhibitorslistrequired = $_POST['language'];
  $ExhibtiorAppointment = $_POST['languages'];
  $Stype = $_POST['Stype'];

  // if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
    // }
    // $imageData=$_FILES['Image'];

    // $imageData=base64_encode(file_get_contents($_FILES['Image']['tmp_name'])); 
    $imageDir = '../../uploads/form-photo/';
    if (!is_dir($imageDir)) {
        mkdir($imageDir, 0777, true);
    }
    $imageTmpPath = $_FILES['Image']['tmp_name']; // Temporary path of the uploaded file
    $imagePath = $imageDir . basename(substr ($imageTmpPath,0,strlen($imageTmpPath)-4)) .  ".jpg";
    
    if (move_uploaded_file($imageTmpPath, $imagePath)) {;
        // $imagePath = substr($imagePath, 3); // Remove the leading '../' for display
    } else {
        $message = "Failed to upload image. Error code: " . $_FILES['Image']['error'];
    }

   
    // echo $imageData;

  $response=null;
  $media_id = null;

  $query = "INSERT INTO `media` (`emp_id`, `name`, `designation`, `company`, `address`, `mobile`, `email`, `city`, `state`, `pincode`, `date`, `visitor`, `language`, `languages`, `image`, `feedback`, `location`, `project_id`, `Type`) VALUES ('$emp_id', '$FullName', '$Designation', '$Company', '$Address', '$MobileNumber', '$EmailAddress', '$City', '$State', '$PinCode', '$VisitDate', '$AddOnVisitor', '$Exhibitorslistrequired', '$ExhibtiorAppointment', '$imagePath', '$Addyourfeedback', '$location', '$project_id', '$Stype')";
  if ($conn->query($query)) {
    $media_id = $conn->insert_id;
    
    $response=['status'=>'success','message'=>'Added-Successfully!','media_id'=>$media_id];
    // $response['status'] = 'success';
    // $response['message'] = ;
    // $response['media_id'] = $media_id;
  } else {
    throw new Exception('Error: '. $sql .'<br>'. $conn->error);
  }


// header('Content-Type: application/json');
echo json_encode($response);
