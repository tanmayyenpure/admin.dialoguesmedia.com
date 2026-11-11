<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    echo"<script>console.log('Emp id not given');</script>";
    header("location: ../login.html");
}

$emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : ''; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOJ Listing</title>
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="../Template/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <style type="text/css">

        /* *{
           margin:0 10px 0 10px;
           align-items: center; 
        } */
    /* Table styles */

    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

a {
    text-decoration: none;
}

li {
    list-style: none;
}

:root {
    --poppins: 'Poppins', sans-serif;
    --lato: 'Lato', sans-serif;
    --light: #8e0c0c;
    --blue: #f0e5e5;
    --grey: #D7DBDD;
    --light-blue: #fff;
    --dark-grey: rgb(165, 158, 158);
    --dark: rgb(67, 67, 67);
    /* --red: #DB504A; */
    --yellow: #fff;
    --light-yellow: #FFF2C6;
    /* --orange: #FD7238; */
    --light-orange: #FFE0D3;
}

a {
    color: white;
}

.text-primary {
    color: #007bff !important;
}

html {
    overflow-x: hidden;
}

body.dark {
    --light: #0C0C1E;
    --grey: #060714;
    --dark: #FBFBFB;
}

body {
    background: var(--grey);
    /* overflow-x: hidden; */
}


/* SIDEBAR */

#sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100%;
    background: var(--light);
    z-index: 2000;
    font-family: var(--lato);
    transition: .3s ease;
    overflow-x: hidden;
    scrollbar-width: none;
}

#sidebar::--webkit-scrollbar {
    display: none;
}

#sidebar.hide {
    width: 60px;
}

#sidebar .brand {
    font-size: 24px;
    font-weight: 700;
    height: 37px;
    display: flex;
    align-items: center;
    color:  #8e0c0c;
    position: sticky;
    top: 0;
    left: 0;
    background: white;
    z-index: 500;
    padding: 10px;
    box-sizing: content-box;
}

#sidebar .brand .bx {
    min-width: 60px;
    display: flex;
    justify-content: center;
}

#sidebar .side-menu {
    width: 100%;
    margin-top: 48px;
}

#sidebar .side-menu li {
    height: 48px;
    background: transparent;
    margin-left: 6px;
    border-radius: 48px 0 0 48px;
    padding: 4px;
}

#sidebar .side-menu li.active {
    background: var(--grey);
    position: relative;
}

#sidebar .side-menu li.active::before {
    content: '';
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    top: -40px;
    right: 0;
    box-shadow: 20px 20px 0 var(--grey);
    z-index: -1;
}

#sidebar .side-menu li.active::after {
    content: '';
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    bottom: -40px;
    right: 0;
    box-shadow: 20px -20px 0 var(--grey);
    z-index: -1;
}

#sidebar .side-menu li a {
    width: 100%;
    height: 100%;
    background: var(--light);
    display: flex;
    align-items: center;
    border-radius: 48px;
    font-size: 15px;
    color: var(--dark);
    white-space: nowrap;
    overflow-x: hidden;
}

#sidebar .side-menu.top li.active a {
    color: #8e0c0c;
}

#sidebar.hide .side-menu li a {
    width: calc(48px - (4px * 2));
    transition: width .3s ease;
}

#sidebar .side-menu li a.logout {
    color: var(--red);
}

#sidebar .side-menu.top li a:hover {
    color: #8e0c0c;
}

#sidebar .side-menu li a .bx {
    min-width: calc(60px - ((4px + 6px) * 2));
    display: flex;
    justify-content: center;
}


/* SIDEBAR */


/* CONTENT */

#content {
    position: relative;
    /* width: calc(100% - 280px); */
    width: 1144px;
    left: 280px;
    transition: .3s ease;
}

#sidebar.hide~#content {
    width: calc(100% - 60px);
    left: 60px;
}


/* NAVBAR */

#content nav {
    height: 56px;
    background-color: #fff;
    padding: 0 24px;
    display: flex;
    align-items: center;
    grid-gap: 24px;
    font-family: var(--lato);
    position: sticky;
    top: 20px;
    left: 0;
    z-index: 1000;
}

#content nav::before {
    content: '';
    position: absolute;
    width: 2px;
    height: 2px;
    bottom: -40px;
    left: 0;
    border-radius: 50%;
    box-shadow: -20px -20px 0 var(--light);
}

#content nav a {
    color: var(--dark);
}

#content nav .bx.bx-menu {
    cursor: pointer;
    color: #8e0c0c;
    font-size: x-large;
}

#content nav .nav-link {
    font-size: 16px;
    transition: .3s ease;
    color: black;
}

#content nav .nav-link:hover {
    color: var(--blue);
}

#content nav form {
    max-width: 400px;
    width: 100%;
    margin-right: auto;
}

#content nav form .form-input {
    display: flex;
    align-items: center;
    height: 36px;
}

#content nav form .form-input input {
    flex-grow: 1;
    padding: 0 16px;
    height: 100%;
    border: none;
    background: var(--grey);
    border-radius: 36px 0 0 36px;
    outline: none;
    width: 100%;
    color: var(--dark);
}

#content nav form .form-input button {
    width: 36px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    /* background: var(--blue); */
    background-color: #8e0c0c;
    /* color: var(--light); */
    color: #fff;
    font-size: 18px;
    border: none;
    outline: none;
    border-radius: 0 36px 36px 0;
    cursor: pointer;
}

#content nav .notification {
    font-size: 20px;
    position: relative;
}

#content nav .notification .num {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid var(--light);
    background: var(--red);
    color: var(--light);
    font-weight: 700;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#content nav .profile img {
    width: 36px;
    height: 36px;
    object-fit: cover;
    border-radius: 50%;
}

#content nav .switch-mode {
    display: block;
    min-width: 50px;
    height: 25px;
    border-radius: 25px;
    background: var(--grey);
    cursor: pointer;
    position: relative;
}

#content nav .switch-mode::before {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    bottom: 2px;
    width: calc(25px - 4px);
    background: var(--blue);
    border-radius: 50%;
    transition: all .3s ease;
}

#content nav #switch-mode:checked+.switch-mode::before {
    left: calc(100% - (25px - 4px) - 2px);
}


/* NAVBAR */


/* MAIN */

#content main {
    width: 100%;
    padding: 36px 24px;
    font-family: var(--poppins);
    max-height: calc(100vh - 56px);
    overflow-y: auto;
}

#content main .head-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    grid-gap: 16px;
    flex-wrap: wrap;
}

#content main .head-title .left h1 {
    font-size: 36px;
    font-weight: 600;
    margin-bottom: 10px;
    /* color: var(--dark); */
}

#content main .head-title .left .breadcrumb {
    display: flex;
    align-items: center;
    grid-gap: 16px;
}

#content main .head-title .left .breadcrumb li {
    color: var(--dark);
}

#content main .head-title .left .breadcrumb li a {
    color: black;
    pointer-events: none;
}

#content main .head-title .left .breadcrumb li a.active {
    color: var(--blue);
    pointer-events: unset;
}

#content main .head-title .btn-download {
    height: 36px;
    padding: 0 16px;
    border-radius: 36px;
    background: var(--blue);
    color: var(--light);
    display: flex;
    justify-content: center;
    align-items: center;
    grid-gap: 10px;
    font-weight: 500;
}

#content main .box-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    grid-gap: 24px;
    margin-top: 36px;
}

#content main .box-info li {
    padding: 24px;
    /* background: var(--light); */
    background-color: #8e0c0c;
    box-shadow: 5px 5px 5px #8e0c0c;
    border-radius: 20px;
    display: flex;
    align-items: center;
    grid-gap: 24px;
}

#content main .box-info li .bx {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    font-size: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    color: #8e0c0c;
}

#content main .box-info li:nth-child(1) .bx {
    background: #fff;
    color: #8e0c0c;
}

#content main .box-info li:nth-child(2) .bx {
    background: #fff;
    color: #8e0c0c;
}

#content main .box-info li:nth-child(3) .bx {
    background: #fff;
    color: #8e0c0c;
}

img {
    height: 25px;
    width: 25px;
    margin: 20px;
}

#sidebar .side-menu li a {
    background-color: #fff;
    border: 1px solid black;
    color: #08010b;
}

.nav {
    background-color: #08010b;
}


/* dropdown */



    .tg  {
        border-collapse: collapse;
        border-spacing: 0;
        /* border-color: black;
        border-style: solid; */
        border-width: 1px;
    }

    /* Table cell styles */
    .tg td {
        /* border-color: black;
        border-style: solid; */
        padding-bottom:10px;
      border-bottom: 1px solid rgb(209, 207, 207);
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        word-break: normal;
    }

    /* Table header styles */
    .tg th {
        /* border-color: black;
        border-style: solid; */
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        word-break: normal;
    }

    /* Styling for specific cells with class tg-4ed6 */
    .tg .tg-4ed6 {
        background-color: black;
        border-color: inherit;
        color: white;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
    .tg .tg-4az1
    {
        background-color:white;
        text-align:center;
        vertical-align:middle;
    }
    .doj-form-row {
        background-color: #D6E3BC;
        text-align: center;
        
    }

    .doj-form-row td input {
        background-color: #D6E3BC;
        text-align: center;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal; /* Adjust as needed */
    }

   table tr th{
    width:auto;
   }
    </style>

</head>

<body id="page-top">
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../img/apple-touch-icon.png" alt="">
            <span class="text">Dialoguesmedia</span>
        </a>
        <ul class="side-menu top">
        <li >
            <a href="../HrmsDashboard.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">HRMS Dashboard</span>
            </a>
        </li>
        <li class="has-submenu">
            <a href="../login.html">
                <i class='bx bxs-megaphone'></i>
                <span class="text">HR Login</span>
            </a>
        </li>
        
    
        <li>
            <!-- <a href="HRTasksListing.php">
                <span class="text" style="text-align: center;padding-left: 20px;">HR Listing</span>
            </a> -->
            <a href="../HR/HRTasks/HRTasksListing.php?emp_id=<?php echo htmlspecialchars($emp_id); ?>">
            <span class="text" style="text-align: center; padding-left: 20px;">HR TasksListing</span>
        </a>
        </li>

        

        <?php if (in_array('Employee Task', $_SESSION['view_access'] ?? [])) : ?>
        <li>
            <a href="../Employee/EmployeeListing.php">
                <span class="text" style="padding-left:20px;">Employee Task</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (in_array('Roaster', $_SESSION['view_access'] ?? [])) : ?>
            <li>
                <a href="../EmployeeRoaster/EmployeesRoaster.php">
                    <span class="text" style="padding-left:20px;">Roaster Management</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (in_array('DOJ', $_SESSION['view_access'] ?? [])) : ?>
            <li class="active">
                <a href="../Date_Of_Joining/DojListing.php">
                    <span class="text" style="padding-left:20px;">DOJ</span>
                </a>
            </li>
        <?php endif; ?>
            <li>
            <?php
                // Check if the employee type is set in the session
                if (isset($_SESSION['type'])) {
                    $employeeType = $_SESSION['type'];

                    // Check if the employee type is 2
                    if ($employeeType == 2) {
                        echo '<a href="../EmployeeRoaster/EmployeeRoaster.php">
                                <i class="bx bxs-people"></i>
                                <span class="text">Attendance Roaster</span>
                            </a>';
                    } 
                } else {
                    // header("location: ../login.html");
                }
                ?>
            </li>
            <li>
            <?php
                // Check if the employee type is set in the session
                if (isset($_SESSION['type'])) {
                    $employeeType = $_SESSION['type'];

                    // Check if the employee type is 2
                    if ($employeeType == 2) {
                        echo '<a href="../Employee/EmployeeListing.php">
                                <i class="bx bxs-people"></i>
                                <span class="text">Employee</span>
                            </a>';
                    } 
                } else {
                    // header("location: ../login.html");
                }
                ?>
            </li>
        </ul>
        <ul class="side-menu">
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
            <!-- <a href="#" class="nav-link">Search here</a> -->
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>

            <a href="#" class="profile">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
             <!-- Page Wrapper -->
        <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger fs-15">Date Of Joining List</h6>
                    <div class="d-flex">
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-info-circle mr-1"></i> Info
                    </button>
                    <!-- Save Icon Button -->
                    <button type="button" class="btn btn-danger ml-2" onclick="CreateNew()">
                        <i class="fas fa-plus"></i> Add
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="tg" style="table-layout: fixed; width: 2375px" id="DojTable">
                    <colgroup>
                            <col style="width: 100px">    
                            <col style="width: 220px">    
                            <col style="width: 450px">   
                            <col style="width: 150px">    
                            <col style="width: 250px">    
                            <col style="width: 140px">   
                            <col style="width: 100px">    
                            <col style="width: 300px">    
                            <col style="width: 100px">    
                            <col style="width: 90px">     
                            <col style="width: 90px">     
                            <col style="width: 110px">  
                            <col style="width: 70px">   
                            <col style="width: 70px">    
                            <col style="width: 100px">  
                            <col style="width: 140px">  
                            <col style="width: 100px">   
                            <col style="width: 160px">   
                            <col style="width: 140px">   
                            <col style="width: 160px">   
                            <col style="width: 220px">   
                            <col style="width: 140px">   
                            <col style="width: 250px">   
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="tg-4ed6" rowspan="2">Sr. No.</th>
                            <th class="tg-4ed6" rowspan="2">Name</th>
                            <th class="tg-4ed6" rowspan="2">College Name</th>
                            <th class="tg-4ed6" rowspan="2">Location </th>
                            <th class="tg-4ed6" rowspan="2">E-mail Id</th>
                            <th class="tg-4ed6" rowspan="2">Contact No.</th>
                            <!-- <th class="tg-4ed6" rowspan="2">Domain</th> -->
                            <th class="tg-4ed6" rowspan="2">Department</th>
                            <th class="tg-4ed6" rowspan="2">Date Of Joining</th>
                            <th class="tg-4ed6" rowspan="2">Duration</th>
                            <th class="tg-4ed6" colspan="2">    Joining Formailites                   </th>
                            <th class="tg-4ed6"rowspan="2">Create Employee</th>
                            <th class="tg-4ed6" colspan="4">Leaving Formalities</th>
                            <th class="tg-4ed6" colspan="3">Completion Certificate</th>
                            <th class="tg-4ed6" rowspan="2">Batch(Session)</th>
                            <th class="tg-4ed6" rowspan="2">TPO Name</th>
                            <th class="tg-4ed6" rowspan="2">Contact No.</th>
                            <th class="tg-4ed6" rowspan="2">E-mail ID</th> 
                            <!-- 23 -->
                        </tr>
                        <tr>
                            <th class="tg-4ed6">EJM(AF)</th>
                            <th class="tg-4ed6">OL(IA)</th>
                            <th class="tg-4ed6">SOD</th>
                            <th class="tg-4ed6">Video</th>
                            <th class="tg-4ed6">Review(LI)</th>
                            <th class="tg-4ed6">Feedback Form</th>
                            <th class="tg-4ed6">Certificate</th>
                            <th class="tg-4ed6">Recommandation Letter</th>
                            <th class="tg-4ed6">Application Letter</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="doj-form-row">
                            <form id="dojform">
                                <td id="SrNo"> Sr No</td>
                                <td> <input type="text" class="form-control" id="name" name="name" placeholder="Name *" required> </td>
                                <td> <input type="text" class="form-control" id="college" name="college" placeholder="College *" required> </td>
                                <td> <input type="text" class="form-control" id="location" name="location" placeholder="Location *" required> </td>
                                <td> <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required> </td>
                                <td> <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile *" maxlength="15"required> </td>
                                <td> <input type="text" class="form-control" id="department" name="department" placeholder="department *" required> </td>
                                <td> <input type="date" class="form-control" id="doj" name="doj" placeholder="Date of Joining" > </td>
                                <td> <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" required> </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="ejm" name="ejm">
                                        <label class="custom-control-label" for="ejm"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="ol" name="ol">
                                        <label class="custom-control-label" for="ol"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_employee" name="is_employee">
                                        <label class="custom-control-label" for="is_employee"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sod" name="sod">
                                        <label class="custom-control-label" for="sod"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="video" name="video">
                                        <label class="custom-control-label" for="video"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="review" name="review">
                                        <label class="custom-control-label" for="review"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="feedback_form" name="feedback_form">
                                        <label class="custom-control-label" for="feedback_form"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="certificate" name="certificate">
                                        <label class="custom-control-label" for="certificate"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="recommendation_letter" name="recommendation_letter">
                                        <label class="custom-control-label" for="recommendation_letter"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="app_letter" name="app_letter">
                                        <label class="custom-control-label" for="app_letter"></label>
                                    </div>
                                </td>
                                <td> <input type="text" class="form-control" id="batch" name="batch" placeholder="Batch" > </td>
                                <td> <input type="text" class="form-control" id="tpo" name="tpo" placeholder="TPO" > </td>
                                <td> <input type="text" class="form-control" id="tpo_contact" name="tpo_contact" placeholder="TPO Contact" > </td>
                                <td> <input type="text" class="form-control" id="tpo_email" name="tpo_email" placeholder="TPO Email" > </td>
                                <!-- <td> <button type="button" > Save </button>
                                <td> <button type="button" > Delete </button> -->
                            </form>
                        </tr>     
                        <?php
                        include "table2.php"                 
                        ?>   
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
</body>
 <script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../Template/js/popper.min.js"></script>
    <script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../Template/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script>
      function handleCheckboxChange(checkbox) {
        if(!window.confirm("Confirm Update field?")){
          checkbox.checked = (checkbox.getAttribute("data-initial-value") == '1') ? 'checked' : '';
          return;
        }
        var id = checkbox.id; // Retrieve the ID from the checkbox
        var value = checkbox.checked ? 1 : 0; // Get the new value (1 if checked, 0 if unchecked)
        var dojId = checkbox.getAttribute('data-dojid');
        var name = checkbox.getAttribute('data-boolkey');
    
    console.log("DOJ_ID: " + dojId + ", BoolKey: " + name);
        // Print the values to the console
        console.log("ID: " + id + ", Value: " + value);
        if (name == 'is_employee'&& value == 1)
        {
            console.log("Creating Employee...");
            CreatEmployee();
        }
        else if(name != 'is_employee' || (name == 'is_employee'&& value == 1) )
        {
        $.ajax({
                url: 'update_doj.php',
                method: 'POST',
                data: {
                    id: dojId,
                    name: name,
                    value: value,
                },
                success: function (response) {
                    // Handle the response if needed
                    
                    if (response.status === 'success') {
                        console.log(response.message);
                    
                } else {
                    alert('Error: ' + response.message);
                }
                }
            });
        }
                
        else
        {
            checkbox.checked = true;
            alert('Cannot Change Employee Already Created');
        }
        // You can now send the values to the server using AJAX or perform any other actions as needed.
    }
    function handleFocus(element) {
        element.dataset.originalValue = element.innerText.trim();
    }

    // Handle blur event
    function handleBlur(element) {
        const id = element.dataset.id;
        const name = element.dataset.name;
        const value = element.innerText.trim();
        const originalValue = element.dataset.originalValue;

        // Check if the value has changed
        if (value !== originalValue) {
            // Send the updated data to your PHP script (update_doj.php)
            $.ajax({
                url: 'update_doj.php',
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                    value: value,
                },
                success: function (response) {
                    // Handle the response if needed
                    
                    if (response.status === 'success') {
                        console.log(response.message);
                    
                } else {
                    alert('Error: ' + response.message);
                    element.innerText =originalValue;
                }
                },
                error: function (error) {
                    // Handle the error if needed
                    console.error(error);
                }
            });
        }
    }
    function CreateNew()
    {
        var formData = {
                    name: document.getElementById('name').value,
                    college: document.getElementById('college').value,
                    location: document.getElementById('location').value,
                    email: document.getElementById('email').value,
                    mobile: document.getElementById('mobile').value,
                    department: document.getElementById('department').value,
                    doj: document.getElementById('doj').value,
                    duration: document.getElementById('duration').value,
                    ejm: $("#ejm").is(":checked") ? 1 : 0,
                    ol: $("#ol").is(":checked") ? 1 : 0,
                    is_employee: $("#is_employee").is(":checked") ? 1 : 0,
                    sod:$("#sod").is(":checked") ? 1 : 0,
                    video: $("#video").is(":checked") ? 1 : 0,
                    review: $("#review").is(":checked") ? 1 : 0,
                    feedback_form: $("#feedback_form").is(":checked") ? 1 : 0,
                    certificate: $("#certificate").is(":checked") ? 1 : 0,
                    recommendation_letter: $("#recommendation_letter").is(":checked") ? 1 : 0,
                    app_letter:$("#app_letter").is(":checked") ? 1 : 0,
                    batch: document.getElementById('batch').value,
                    tpo: document.getElementById('tpo').value,
                    tpo_contact: document.getElementById('tpo_contact').value,
                    tpo_email: document.getElementById('tpo_email').value
                };
// AJAX POST request
            $.ajax({
                type: 'POST',
                url: 'create_doj.php',
                data: formData,
                success: function (response) {
                    // Handle success response here
                    if (response.status === 'success') {
                    alert('Added successfully!');
                    window.location.href = 'DojListing.php';
                    
                } else {
                    alert('Error: ' + response.message);
                }

                    // You can update the UI or perform other actions based on the response
                },
                error: function (error) {
                    // Handle error here
                    console.error(error);
                }
            });
    }
    function CreatEmployee()
    {
        
    }

    </script>
</html>

