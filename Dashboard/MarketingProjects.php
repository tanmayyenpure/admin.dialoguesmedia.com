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

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
	<title>Marketing Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="../img/apple-touch-icon.png" alt="">
			<span class="text">Dialoguesmedia</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="AdminDashboard.php">
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
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="#" href="#">Home</a>
							<!--<a class="active" href="#">Home</a>-->
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info" id="projectList">
				
			</ul>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
        $.ajax({
            url: '../Project/read_project.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    var projects = response.data;

                    // Dynamically create list items based on the fetched projects
                    projects.forEach(function (projects) {
                        var listItem = $('<li>');
                        listItem.html(`
                            <i class='bx bxs-calendar-check'></i>
                            <span class="text">
                                <h3><a href="../MarketProjects/MarkProjectListing.php?project_id=${projects.pid}">${projects.Pname}</a></h3>
                                <!-- You can display other project details here -->
                            </span>
                        `);

                        // Append the created list item to the ul
                        $('#projectList').append(listItem);
                    });
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