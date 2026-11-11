<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <title>Employee Form</title>
</head>
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
    width: 100%;
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



</style>

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
                <h6 class="m-0 font-weight-bold text-danger fs-30">Employee</h6>
                <div class="d-flex">
                <a href="EmployeeListing.php" class="btn btn-danger btn-circle" data-toggle="tooltip" data-title="Employee Listing">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
            <form id="EmployeeForm">
                <div class="form-group">
                    <label for="emp_id">Employee ID</label>
                    <input type="text" placeholder="Employee-Id" id="emp_id" class="form-control" name="emp_id" required readonly>
                </div>

                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" placeholder="Name" id="name" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="aadhar_card_no">Aadhar Card Number *</label>
                    <input type="text" placeholder="Aadhar Card Number" id="aadhar_card_no" class="form-control" name="aadhar_card_no" maxlength="12" required>
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
                        <option value="5">HR</option>
                        <option value="6">Others</option>
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
                <button class="btn btn-danger" type="button" onclick="<?php echo $onClickFunction; ?>; resetFormValues(); location.reload();">
                    <?php echo $buttonText; ?>
                </button>
            </form>
            </div>
            </div>
        </div>
        </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <?php
   function getNextEmployeeCode() 
   {
       // Read the query from the text file
       $queryFilePath = 'GetMaxCode.txt';
       $query = file_get_contents($queryFilePath);
   
       include '../formconnection.php'; // Include your database connection file
   
       $result = $conn->query($query);
   
       if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
           $maxCode = $row["max_code"];
           if ($maxCode == '0') {
               $nextCode = 'DM001';
           } else {
               $nextNumber = (int)substr($maxCode, 2) + 1;
               $nextCode = 'DM' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
           }
           // Return the next code
           return $nextCode;
       }
   
       $conn->close();
   }
   function setEmployeeValues($emp_id)
   {
    try
    {
        $baseURL = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $readEmployeeUrl = "$baseURL/read_employee.php?emp_id=$emp_id";
        $readEmployeeData = file_get_contents($readEmployeeUrl);
        $employeeData = json_decode($readEmployeeData, true);
        if ($employeeData['status'] === 'success') {
            // Set values in all fields using JavaScript
            echo "<script>
            document.getElementById('emp_id').value = '{$employeeData['data']['emp_id']}';
            document.getElementById('name').value = '{$employeeData['data']['name']}';
            document.getElementById('aadhar_card_no').value = '{$employeeData['data']['aadhar_card_no']}';
            document.getElementById('pan_card').value = '{$employeeData['data']['pan_card']}';
            document.getElementById('mobile_number').value = '{$employeeData['data']['mobile_number']}';
            document.getElementById('job_role').value = '{$employeeData['data']['job_role']}';
    
            var departmentTypeDropdown = document.getElementById('department_type');
            var projectDropdown = document.getElementById('project_id');
            var projectGroup = document.getElementById('projectGroup');
            var departmentTypeValue = '{$employeeData['data']['department_type']}';
            departmentTypeDropdown.value = departmentTypeValue !== 'null' ? departmentTypeValue : departmentTypeDropdown.options[0].value;
            projectGroup.style.display = (departmentTypeValue === '2') ? 'block' : 'none';
            // Set project_id dropdown value if department_type is 2
            if (departmentTypeValue === '2') {
                var projectValue = '{$employeeData['data']['project_id']}';
                // Set project_id dropdown value if it's not null, otherwise set the first option
                projectDropdown.value = projectValue !== 'null' ? projectValue : projectDropdown.options[0].value;
            }
        </script>";
        } else {
            echo "<script>alert('Error: Unable to fetch employee data');</script>";
        }
    }
    catch (Exception $e)    
    {
        echo "<script>alert('Error: Caught exception - " . $e->getMessage() . "');</script>";
    }
   }
   
   if (isset($_GET['emp_id'])) 
   {
    $emp_id = $_GET['emp_id'];
    setEmployeeValues($emp_id);
    }
 else {
    $emp_id = getNextEmployeeCode();
    echo "<script>document.getElementById('emp_id').value = '$emp_id';</script>";
    } 
    ?>
</body>
<script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
    <script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../Template/js/popper.min.js"></script>
    
   
<script>
     $(document).ready(function () {
    // Initialize DataTable
    $('[data-toggle="tooltip"]').tooltip();
    $.ajax({
    url: '../Project/read_project.php',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        if (response.status === 'success') {
            var projects = response.data;

            // Clear existing options in the select dropdown
            $('#project_id').empty();

            // Populate dropdown options
            projects.forEach(function (project) {
                $('#project_id').append($('<option>', {
                    value: project.pid,
                    text: project.Pname
                }));
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
    function deleteForm()
    {
        var formData = new FormData(document.getElementById('EmployeeForm'));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_employee.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.href='EmployeeListing.php'; 
                        
                    }
                    else
                    {
                        alert("error :- " + response.message); 
                    }
                }
            };

            xhr.send(formData);
    }
    function updateForm()
    {
            var formData = new FormData(document.getElementById('EmployeeForm'));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_employee.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message); 
                        location.reload();
                    }
                    else
                    {
                        alert("error :- " + response.message); 
                    }
                }
            };

            xhr.send(formData);
    }
    function submitForm()
     {
            var formData = new FormData(document.getElementById('EmployeeForm'));
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'create_employee.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message); 
                        location.reload();
                    }
                    else
                    {
                        alert("error :- " + response.message); 
                    }
                }
            };

            xhr.send(formData);
     }

     function resetFormValues() {
    var elements = [
        'name', 'aadhar_card_no', 'pan_card', 'mobile_number', 
        'department_type', 'project_id', 'job_role'
    ];

    elements.forEach(function(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                element.value = ''; // Clear input and textarea fields
            } else if (element.tagName === 'SELECT') {
                element.selectedIndex = 0; // Reset to first option
            } else {
                element.innerText = ''; // Reset text content for other elements
            }
        }
    });

    // If using checkboxes or radio buttons, reset them too
    var checkboxes = document.querySelectorAll('input[type="checkbox"], input[type="radio"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
}


</script>
<script>
        function handleDepartmentChange() {
            var departmentDropdown = document.getElementById('department_type');
            var projectGroup = document.getElementById('projectGroup');

            // Show or hide the project dropdown based on the selected department
            projectGroup.style.display = (departmentDropdown.value === '2') ? 'block' : 'none';
        }
    </script>
    
</html>

