<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <title>Employee Form</title>
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
            <a href="../Dashboard/AdminDashboard">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            <li class="has-submenu">
        <a href="#">
            <i class='bx bxs-megaphone'></i>
            <span class="text">Marketing</span>
        </a>
        <ul class="submenu">
        <li><a href="../Dashboard/MarketingProjects.php">
            <span class="text" style="text-align: center;padding-left: 20px;">My Projects</span>
        </a>
        </li>
        <li><a href="../Project/ProjectListing.php">
            <span class="text" style="text-align: center;padding-left: 20px;">New Project</span>
        </a></li>
            <!-- Add more sub-items as needed -->
        </ul>
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
        <div class="popup" id="popup-2">
        <div class="content">
            <div class="close-btn"></div>
            <div class="card shadow mb-4">
            <div class="card-header py-3  d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-danger fs-30">Project</h6>
                <div class="d-flex">
                <a href="ProjectListing.php" class="btn btn-danger btn-circle" data-toggle="tooltip" data-title="Employee Listing">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
            <form id="EmployeeForm">
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" placeholder="Name" id="name" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="aadhar_card_no">Project Description</label>
                    <input type="text" placeholder="Project Description" id="project_description" class="form-control" name="project_description" maxlength="12" required>
                </div>

                <div class="form-group">
                    <label for="pan_card">PAN Card</label>
                    <input type="text" placeholder="PAN Card" id="pan_card" class="form-control" name="pan_card">
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" placeholder="Mobile Number" id="mobile_number" class="form-control" name="mobile_number" maxlength="15">
                </div>

                <div class="form-group">
                    <label for="department_type">Department Name *</label>
                    <select id="department_type" class="form-control" name="department_type" onchange="handleDepartmentChange()">
                        <option value="1">Human Resources</option>
                        <option value="2">Marketing</option>
                        <option value="3">Sales</option>
                        <option value="4">Web</option>
                        <option value="5">Others</option>
                    </select>
                </div>

                <div class="form-group" id="projectGroup" style="display:none;">
                    <label for="project_id">Project *</label>
                    <select id="project_id" class="form-control" name="project_id">
                        <!-- Add more projects as needed -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="job_role">Job Role</label>
                    <input type="text" placeholder="Job Role" id="job_role" class="form-control" name="job_role">
                </div>
                <?php
                    $buttonText = isset($_GET['emp_id']) ? 'Save Employee' : 'Add Employee';
                    $onClickFunction = isset($_GET['emp_id']) ? 'updateForm()' : 'submitForm()';

                    // Add a condition for delete
                    if (isset($_GET['emp_id']) && isset($_GET['delete'])) {
                        $onClickFunction = 'deleteForm()';
                        $buttonText = 'Delete Employee';
                    }
                ?>
                <button class="btn btn-danger" type="button" onclick="<?php echo $onClickFunction; ?>">
                    <?php echo $buttonText; ?>
                </button>
            </form>
            </div>
            </div>
        </div>
        </div>
		</main>
		<!-- MAIN -->