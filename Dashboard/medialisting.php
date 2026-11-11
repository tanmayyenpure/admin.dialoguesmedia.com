<?php
session_start();
if (!isset($_SESSION["AdminLoginId"])) {
    header("location: ../AdminLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Projects Listing</title>
    <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
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
            <a href="../Dashboard/AdminDashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
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
                    <h6 class="m-0 font-weight-bold text-danger fs-15">Media List</h6>
                    <div class="d-flex">
                        <a href="create_project.php" class="btn btn-danger btn-circle" data-toggle="tooltip" data-title="Create New Project">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="employeetable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-header">
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Date</th>
                                    <th>Visitor</th>
                                    <th>location</th>
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

    $.ajax({
        url: 'read_media.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            if (response.status === 'success') 
            {
                dataTable.clear().draw();
                if (!Array.isArray(response.data)) {
                    var employee = response.data;
                    dataTable.row.add([
                    employee.name,
                    employee.designation,
                    employee.company,
                    employee.address,
                    employee.mobile,
                    employee.email,
                    employee.city,
                    employee.state,
                    employee.pincode,
                    employee.date,
                    employee.visitor,
                    employee.location,
                    '<a href="ProjectForm.php?pid=' + employee.id + '" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>  ' +
                    '<a href="ProjectForm.php?pid=' + employee.id + '&delete=' + employee.id+'" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></a>'

                ]).draw(false);
                } else {
                    // Handle multiple lines of data
                    response.data.forEach(function (employee) {
                        dataTable.row.add([
                            employee.name,
                            employee.designation,
                            employee.company,
                            employee.address,
                            employee.mobile,
                            employee.email,
                            employee.city,
                            employee.state,
                            employee.pincode,
                            employee.date,
                            employee.visitor,
                            employee.location,
                            '<a href="ProjectForm.php?Pid=' + employee.id + '" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>  ' +
                            '<a href="ProjectForm.php?Pid=' + employee.id + '&delete=' + employee.id+'" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></a>'
                        ]);
                    });
                    dataTable.draw(false);
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

</script>

</html>
