<?php
session_start();
if (!isset($_SESSION["AdminLoginId"])) {
    header("location: ../AdminLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
	<title>Marketing Project Employees List</title>
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
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="../img/apple.png" alt="">
			<span class="text">Dialoguesmedia</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="../Dashboard/MarketingProjects.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            <li>
			<a href="../Project/ProjectListing.php">
            <span class="text" style="text-align: center;padding-left: 20px;">New Project</span>
        	</a>
			</li>
			<li>
			<a href="../Employee/EmployeeListing.php">
            <span class="text" style="text-align: center;padding-left: 20px;">New Employees</span>
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
        <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger fs-15">Project <?php $project_id = isset($_GET['project_id'])?$_GET['project_id']:' X '; echo $project_id; ?> List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="employeetable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-header">
                                    <th>Emp_ID</th>
                                    <th>Name</th>
                                    <th>Saved Count</th>
                                    <th>Submitted Count</th>
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
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../Template/js/popper.min.js"></script>
    <script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function () {
    // Initialize DataTable
    $('[data-toggle="tooltip"]').tooltip();
    var dataTable = $('#employeetable').DataTable({
    });

    $.ajax({
        url: 'read_marketdata.php?project_id=<?php $project_id = isset($_GET['project_id'])?$_GET['project_id']:' X '; echo $project_id; ?>',
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            if (response.status === 'success') 
            {
                dataTable.clear().draw();
                if (!Array.isArray(response.data)) {
                    var projectemployee = response.data;
                    var savedUrl = '../MarketType/MarkTypeListing.php?emp_id=' + projectemployee.emp_id + '&Type=1&project_id=<?php echo $project_id?>';
                    var submitUrl = '../MarketType/MarkTypeListing.php?emp_id=' + projectemployee.emp_id + '&Type=2&project_id=<?php echo $project_id?>';

                    dataTable.row.add([
                        '<a href="' + savedUrl + '" class="text-primary">' + projectemployee.emp_id + '</a>',
                        '<a href="' + savedUrl + '" class="text-primary">' + projectemployee.name + '</a>',
                        projectemployee.saved,
                        projectemployee.submit
                    ]).draw(false);
                } else {
                    // Handle multiple lines of data
                    response.data.forEach(function (projectemployee) {
                        var savedUrl = '../MarketType/MarkTypeListing.php?emp_id=' + projectemployee.emp_id + '&Type=1&project_id=<?php echo $project_id?>';
                        var submitUrl = '../MarketType/MarkTypeListing.php?emp_id=' + projectemployee.emp_id + '&Type=2&project_id=<?php echo $project_id?>';

                        dataTable.row.add([
                            '<a href="' + savedUrl + '" class="text-primary">' + projectemployee.emp_id + '</a>',
                            '<a href="' + savedUrl + '" class="text-primary">' + projectemployee.name + '</a>',
                             projectemployee.saved,
                            projectemployee.submit
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

    </script>
</body>
</html>