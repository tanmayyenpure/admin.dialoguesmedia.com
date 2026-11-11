<?php
session_start();
// if (!isset($_SESSION["AdminLoginId"])) {
//     header("location: ../AdminLogin.php");
// }
$emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : ''; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Listing</title>
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
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
    width: 1064px;
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



        .table-header
        {
            background-color: black;
            color: white;
            border: none;
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
            <a href="../HR/HRTasks/HRTasksListing.php?emp_id=<?= $emp_id ?>">
            <span class="text" style="text-align: center; padding-left: 20px;">HR TasksListing</span>
        </a>
        </li>

       


        <?php if (in_array('Employee Task', $_SESSION['view_access'] ?? [])) : ?>
        <li class="active">
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
            <li>
                <a href="../Date_Of_Joining/DojListing.php">
                    <span class="text" style="padding-left:20px;">DOJ</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
            
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Search here</a>
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
                    <h6 class="m-0 font-weight-bold text-danger fs-15">Employees List</h6>
                    <div class="d-flex">
                        <a href="EmployeeForm.php" class="btn btn-danger btn-circle" data-toggle="tooltip" data-title="Create New Employee">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="employeetable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-header">
                                    <th>Emp_ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Attendance</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
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
  <!-- Page level plugins -->
  <script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
    <script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../Template/js/popper.min.js"></script>
    <script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function () {
    // Initialize DataTable
    $('[data-toggle="tooltip"]').tooltip();
    var dataTable = $('#employeetable').DataTable({
        "order": [[0, "asc"]]
    });

    // Get today's date in the format YYYY-MM-DD
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    $.ajax({
        url: 'read_employee.php',
        type: 'GET',
        dataType: 'json',
        data: { date: today }, // Send the current date
        success: function (response) {
            if (response.status === 'success') {
                dataTable.clear().draw();

                var img1 = '../img/img1.png'; // Image for attendance = 1
                var img2 = '../img/img2.png'; // Image for attendance = 0
                var img3 = '../img/img3.png'; // Image for attendance = NULL

                function getAttendanceImage(attendance) {
                    if (attendance == 1) {
                        return img1;
                    } else if (attendance == 0) {
                        return img2;
                    } else {
                        return img3;
                    }
                }

                if (!Array.isArray(response.data)) {
                    var employee = response.data;
                    var attendanceImg = getAttendanceImage(employee.attendance);
                    dataTable.row.add([
                        '<a href="EmployeeTasks/EmployeeTasksListing.php?emp_id=' + employee.emp_id + '" class="text-primary">' + employee.emp_id + '</a>',
                        '<a href="EmployeeTasks/EmployeeTasksListing.php?emp_id=' + employee.emp_id + '" class="text-primary">' + employee.name + '</a>',
                        employee.department_name,
                        '<img src="' + attendanceImg + '" alt="Attendance Status" class="small-img">'
                    ]).draw(false);
                } else {
                    response.data.forEach(function (employee) {
            var attendanceImg = getAttendanceImage(employee.attendance);
            dataTable.row.add([
                '<a href="EmployeeTasks/EmployeeTasksListing.php?emp_id=' + employee.emp_id + '" class="text-primary">' + employee.emp_id + '</a>',
                '<a href="EmployeeTasks/EmployeeTasksListing.php?emp_id=' + employee.emp_id + '" class="text-primary">' + employee.name + '</a>',
                employee.department_name,
                '<img src="' + attendanceImg + '" alt="Attendance Status" class="small-img">',
                employee.location ? '<a href="https://www.google.com/maps?q=' + employee.location + '" target="_blank" style="color: blue; text-decoration: underline;" onclick="startTracking()">Open Location</a>' : 'Unknown'
               // If location is NULL, show 'Unknown'
            ]).draw(false);
        });

                }

                console.log("DataTable initialized with data:", response.data);
            } else {
                console.error('Error fetching data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});

function startTracking() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude;

                console.log("Live Location:", latitude, longitude);

                // Send location to server via AJAX
                fetch('save_location.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `latitude=${latitude}&longitude=${longitude}`
                }).then(response => response.text())
                  .then(data => console.log("Server Response:", data))
                  .catch(error => console.error("Error:", error));

            },
            function (error) {
                if (error.code === error.TIMEOUT) {
                    alert("Location request timed out. Please try again.");
                } else if (error.code === error.PERMISSION_DENIED) {
                    alert("Location access denied. Please allow location permissions.");
                } else if (error.code === error.POSITION_UNAVAILABLE) {
                    alert("Location unavailable. Try again later.");
                } else {
                    alert("An unknown error occurred.");
                }
            },
            { timeout: 10000 } // Timeout set to 10 seconds
        );
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}


        // Function to get image URL based on attendance value
        function getAttendanceImage(attendance) {
            if (attendance === 1) {
                return 'images/img1.png'; // Image for attendance = 1
            } else if (attendance === 0) {
                return 'images/img2.png'; // Image for attendance = 0
            } else {
                return 'images/img3.png'; // Image for attendance = NULL
            }
        }
</script>
<style>
        .small-img {
            width: 20px;
            height: 20px;
        }
        .center-col {
        text-align: center;
    }
    </style>
   
</html>