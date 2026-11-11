<?php 
  session_start();
  if(!isset($_SESSION['loggedin'])){
    echo "<script>window.location='AdminLogin.php'</script>";
    exit();
  }


  include 'api/conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin-panel</title>


</head>

<script src="https://kit.fontawesome.com/b097944c55.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="css/style.css" />

<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">

      <!-- side bar -->
      <?php include 'inc/sidebar.php'; ?>
      <!-- side bar end -->

      <!-- top bar and content -->
      <div class="col-10  rightbar">

        <!-- top bar -->
        <?php include 'inc/topbar.php'; ?>
        <!-- top bar end -->


        <!-- main-content -->
        <div class="col m-1">
          <div class="main-content">


            <?php 
            if(isset($_GET['page'])){
              if($_GET['page']=='guestlist'){
                include 'pages/guestlist.php';
              }
              elseif($_GET['page']=='club'){
                include 'pages/club.php';
              }
              elseif($_GET['page']=='dining'){
                include 'pages/dining.php';
              }
              elseif($_GET['page']=='bookings'){
                include 'pages/bookings.php';
              }
              elseif($_GET['page']=='revenue'){
                include 'pages/revenue.php';
              }
              elseif($_GET['page']=='blogs'){
                include 'pages/blogs.php';
              }
              elseif($_GET['page']=='dashboard'){
                include 'pages/dashboard.php';
              }
              elseif($_GET['page']=='manage_club'){
                include 'pages/manage_club.php';
              }
              elseif($_GET['page']=='manage_dining'){
                include 'pages/manage_dining.php';
              }
              elseif($_GET['page']=='contact_us'){
                include 'pages/contact_us.php';
              }
              elseif($_GET['page']=='subscribers'){
                include 'pages/subscribers.php';
              }
              elseif($_GET['page']=='event_details'){
                include 'pages/event_details.php';
              }
              elseif($_GET['page']=='manage_users'){
                include 'pages/manageusers.php';
              }
              else{
                include 'pages/dashboard.php';
              }
            }
            else{
              include 'pages/dashboard.php';
            }
              
            
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>



</body>

<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="js/main.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="js/export_data.js"></script>


