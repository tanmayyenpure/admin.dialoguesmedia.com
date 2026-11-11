<?php
session_start();

// if (!isset($_SESSION["AdminLoginId"])) {
// 	header("location: ../AdminLogin.php");
// }
// if (isset($_POST['logout'])) {
// 	session_destroy();
// 	header("location: ../AdminLogin.php");
// 	exit;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="../Template/css/bootstrap.min.css"> -->
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<!-- <link rel="stylesheet" href="../css/style.css"> -->

	<title>Admin Dashboard</title>
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
    color:#8e0c0c;
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
    width: calc(100% - 280px);
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



		/* Styling for the submenu */
		.submenu {
			display: none;
			/* Hide the submenu by default */
			position: relative;
			background-color: #8e0c0c01;
			/* Background color of the submenu */
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
			/* Optional: Box shadow for a nice effect */
			/* //z-index: 1; */
			/* Ensure the submenu appears above other content */
		}

		/* Styling for the submenu items */
		.submenu li {
			display: block;
		}

		.submenu li a {
			display: block;
			/* padding: 10px 20px;
			Padding for submenu item */
			color: #333;
			/* Text color */
			text-decoration: none;
			/* Remove underline */
		}

		.submenu li a:hover {
			background-color: #8e0c0c;
			/* Background color on hover */
		}

		/* Show the submenu when parent <a> is hovered */
		a:hover+.submenu,
		.submenu:hover {
			display: block;
		}
		/* hrms btn  */
		.btn-container {
			/* position: fixed; */
			bottom: 20px;
			margin-bottom: 50px;
			margin-top:50px;
			/* Adjust this value as needed */
		}

		.btn {
			padding: 10px 20px;
			background-color: #8e0c0c;
			border: 2px solid white;
			border-radius: 20px;
			text-align: center;	
		}

		@media (max-width: 780px) {
			#content {
				width: 1144px;
			}
		}

	</style>

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
				<a href="">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Main Dashboard</span>
				</a>
			</li>
			<li class="has-submenu">
				<a href="#">
					<i class='bx bxs-megaphone'></i>
					<span class="text">Marketing</span>
				</a>

				<!-- Submenu for Marketing -->
				<ul class="submenu" >
					<!-- Submenu item for My Projects -->
					<li>
						<a href="../Dashboard/MarketingProjects.php">
							<span class="text" style="text-align: center;padding-left: 20px;">My Projects</span>
						</a>
					</li>
					<!-- Submenu item for New Project -->
					<li>
						<a href="../Project/ProjectListing.php">
							<span class="text" style="text-align: center;padding-left: 20px;">New Project</span>
						</a>
					</li>
				</ul>
			<li><a href="#">
					<span class="text" style="text-align: center;padding-left: 20px;">Digital Marketing</span>
				</a></li>
			<li><a href="#">
					<span class="text" style="text-align: center;padding-left: 20px;">Photography</span>
				</a></li>
			<li><a href="../Media/client_medialisting.php">
					<span class="text" style="text-align: center;padding-left: 20px;">Media Data</span>
				</a></li>
				<li><a href="../HRMS/HR/EmployeeForm.php">
					<span class="text" style="text-align: center;padding-left: 20px;">Create Employee</span>
				</a></li>
				<li><a href="../HRMS/employeelisting.php">
					<span class="text" style="text-align: center;padding-left: 20px;">Employee Details</span>
				</a></li>
				<li><a href="../HRMS/HR/HRListing.php">
					<span class="text" style="text-align: center;padding-left: 20px;">HR Listing</span>
				</a></li>
				<li><a href="../ManageUsers/Users.php">
					<span class="text" style="text-align: center;padding-left: 20px;">Manage User</span>
				</a></li>
		</ul>
		</li>
		<div class="btn-container">
			<a href="../HRMS/HrmsDashboard.php" class="btn" style="left: 87px; position: relative;">
				<span class="text" style="text-align: center;padding-left: 0px; top: 0px;position:relative;color:white;">HRMS</span>
			</a>
		</div>
		
		<!-- Add more sub-items as needed -->
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<!-- <a href="#" class="nav-link">Search here</a> -->
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<div class="logout-btn">
				<form method="post" action="">
					<input style="font-family: 'Cooper', sans-serif; color: white; background-color:#8e0c0c; padding: 10px 20px; cursor: pointer;font-style: normal; border: none;" type="submit" name="logout" value="Logout">
				</form>
			</div>
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
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="#" href="#">Home</a>
							<!--<a class="active" href="#">Home</a>-->
						</li>
					</ul>
				</div>
			</div>
			<div style="display:none;">
				<ul class="box-info">
					<li>
						<i class='bx bxs-calendar-check'></i>
						<span class="text">
							<h3><a href="./empID.html">Project-1</a></h3>
							<!-- <p>Project1</p> -->
						</span>
					</li>
					<li>
						<i class='bx bxs-calendar-check'></i>
						<span class="text">
							<h3><a href="dddd.htm">Project-2</a></h3>
							<!--<p>Project2</p>-->
						</span>
					</li>
					<li>
						<i class='bx bxs-calendar-check'></i>
						<span class="text">
							<h3><a href="./home.html">Project-3</a></h3>
							<!-- <p>Project3</p>-->
						</span>
					</li>
				</ul>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>

</html>