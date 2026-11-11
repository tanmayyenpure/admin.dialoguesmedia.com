<?php
session_start();
if (!isset($_SESSION["AdminLoginId"])) {
    header("location: ../AdminLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Listing</title>
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        *{
            text-align:center;
        }
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
			<li class="active">
            <a href="../HrmsDashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            
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