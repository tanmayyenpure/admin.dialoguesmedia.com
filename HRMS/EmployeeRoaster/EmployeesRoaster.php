<?php
session_start();
// if (!isset($_SESSION['emp_id'])) {
//     echo "<script>console.log('Emp id not given');</script>";
//     // header("location: ../login.html");
// }

$emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : ''; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Roaster </title>
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="print.css" media="print">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.16.0/themes/prism.min.css">
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




#popup {
    display: none;
    position: fixed;
    height: 15%;
    width: 25%;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow-y: auto; /* Enables vertical scrolling */
    max-height: 40%; /* Limits the height so scrolling appears when content is long */
}


#popup-content {
    margin-bottom: 10px;
    text-align: center;  
}

         /* Tooltip container */
         .tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Position above the td */
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
            content: " ";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: black transparent transparent transparent;
        }

        /* Show the tooltip text when hovering over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
        
        .table-header {
            background-color: black;
            color: white;
            border: none;
        }

        #legendTable,
        #absenceLegendTable {
            display: none;
            margin: 0 auto;
            /* Center the table horizontally */
        }

        #legendTable,
        #absenceLegendTable,
        #legendTable th,
        #absenceLegendTable th,
        #legendTable td,
        #absenceLegendTable td {
            text-align: center;
            /* Center the text inside the cells */
            border-collapse: collapse;
            border: 1px solid #000;
        }

        /* abbreviation css  */
        #tableContainer {
            display: none;
            /* Initially hide the table container */
        }

        .table-container {
            display: flex;
        }

        .table {
            border-collapse: collapse;
            width: 30%;
            text-align: center;
            margin-right: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 4px;
        }

        .table-header th {
            background-color: #DBDBDB;
            color: black;
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
            <li class="active">
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
   
            <li>
                <?php
                // Check if the employee type is set in the session
                if (isset($_SESSION['type'])) {
                    $employeeType = $_SESSION['type'];

                    // Check if the employee type is 2
                    if ($employeeType == 2) {
                        echo '<a href="../Employee/EmployeeListing.php">
                                <i class="bx bxs-people"></i>
                                <span class="text">Employees</span>
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
            <i class='bx bx-menu'></i>
            <!-- <a href="#" class="nav-link">Search here</a> -->
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
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
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger fs-15">Search Filters</h6>
                </div>
                <div class="card-body">
                <form id="searchForm">
    <div class="row">
        
        <div class="col-md-4 mb-3">
            <label for="employees-datalist">Employee</label>
            <input type="text" class="form-control" placeholder="Emp Id" list="list-employees" id="employees-datalist" name="emp_id" value="" oninput="fetchEmployeeName(this.value)">
            <datalist id="list-employees"></datalist>
        </div>
        
        <div class="col-md-4 mb-3">
    <label for="name-datalist">Name</label>
    <span id="name-datalist" class="form-control-plaintext"></span>
</div>


        <div class="col-md-4 mb-3">
            <label for="department-datalist">Department</label>
            <span id="department-datalist" class="form-control-plaintext"></span>
        </div>
        <div class="col-md-4 mb-3">
            <label for="date-datalist">Select Month</label>
            <input type="month" class="form-control" placeholder="Month / Time Period" id="date-datalist" name="month" value="<?php echo date('Y-m'); ?>" required>
        </div>

        <div class="col-md-4 mb-3">
                <label for="absence">Absence Type</label>
                <select class="form-control custom-select" name="ab_reason" id="ab_reason">
                    <option value="" selected>Select Ab Reason (optional)</option>
                    <option value="Earned Leave">P - Earned Leave</option>
                    <option value="Privieged Leave">P - Privieged Leave</option>
                    <option value="Sick Leave">P - Sick Leave</option>
                    <option value="Casual Leave">P - Casual Leave</option>
                    <option value="Maternity Leave">P - Maternity Leave</option>
                    <option value="Bereavement Leave">P - Bereavement Leave</option>
                    <option value="Compensatory Off">P - Compensatory Off</option>
                    <option value="Leave Without Pay">Leave Without Pay</option>
                    <option value="Sabbatical Leave">Sabbatical Leave</option>
                    <option value="Childcare Leave">Childcare Leave</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="other_reason">Other Absent Reason</label>
                <input type="text" name="other_reason" id="other_reason" class="form-control" placeholder="Specify reason (optional)">
            </div>

        <div class="col-md-4 mb-3">
            <label for="daysDropdown">Days</label>
            <select class="form-select custom-select" id="daysDropdown" name="daysDropdown">
                <option value="" disabled selected>Select a Days</option>
                <script>
                    for (let i = 1; i <= 30; i++) {
                        document.write(`<option value="${i}">${i}</option>`);
                    }
                </script>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="datesDropdown">Date</label>
            <select class="form-select custom-select" id="datesDropdown" name="day" required>
                <option value="" disabled selected>Select a Date</option>
                <script>
                    for (let i = 1; i <= 31; i++) {
                        document.write(`<option value="${i}">${i}</option>`);
                    }
                </script>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button id="addButton" class="btn btn-danger mr-2">Add Days</button>
        <button id="addDateButton" class="btn btn-danger mr-2">Add Date</button>
        <button class="btn btn-danger" type="button" onclick="GenerateRoster()">GR</button>
    </div>
</form>
<script>
function fetchEmployeeName(empId) {
    if (empId.length === 0) {
        document.getElementById('employees-datalist').textContent = '';
        document.getElementById('name-datalist').textContent = ''; // Clear name
        document.getElementById('department-datalist').textContent = ''; // Clear department
        return;
    }

    // Display the employee ID in the span
    document.getElementById('employees-datalist').textContent = empId;

    fetch(`emp_name.php?emp_id=${empId}`)
        .then(response => response.json())
        .then(data => {
            if (data.name) {
                document.getElementById('name-datalist').textContent = data.name; // Set name
                document.getElementById('department-datalist').textContent = data.department || ''; // Set department
            } else {
                document.getElementById('name-datalist').textContent = ''; // Clear name if not found
                document.getElementById('department-datalist').textContent = ''; // Clear department if not found
            }
        })
        .catch(error => {
            console.error('Error fetching employee name:', error);
        });
}

</script>
                    <!-- Popup HTML -->
                <div id="popup" >
                    <div id="popup-content"></div>
                    <!-- <button class="btn btn-danger"  onclick="closePopup()">Close</button> -->
                </div>

                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>


                    <!-- Roaster Data -->
                    <div class="card shadow mb-4" id="RoasterData">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-danger fs-15">Roaster</h6>
                            <button onclick="printData()" class="btn btn-danger" id="RoasterPrint" style="display:none;">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                        <tr class="table-header" style="margin:auto; text-align:center;" cellspacing="0">
                                            <th colspan="5" style="background-color:rgb(148, 3, 3); color:white; border:1px solid #000; height: 40px; width: 100px; font-size: 16px;">Month</th>
                                            <th colspan="10" id="Month" style="background-color:#ffffff; color:black; border:1px solid #000; height: 40px; width: 150px; font-size: 16px;"></th>
                                            <th colspan="8" style="background-color:rgb(148, 3, 3); color:white; border:1px solid #000; height: 40px; width: 120px; font-size: 16px;">Year</th>
                                            <th colspan="12" id="Year" style="background-color:#ffffff; color:black; border:1px solid #000; height: 40px; width: 150px; font-size: 16px;"></th>
                                        </tr>
                                        <tr style="background-color: rgb(148, 3, 3);color:white;text-align:center; border: 1px solid #000;">
                                            <th style="border: 1px solid #000; padding: 8px;">Name</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d1">1</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d2">2</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d3">3</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d4">4</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d5">5</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d6">6</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d7">7</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d8">8</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d9">9</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d10">10</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d11">11</th>
                                            <th style="border: 1px solid #000; padding: 5px;" id="d12">12</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d13">13</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d14">14</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d15">15</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d16">16</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d17">17</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d18">18</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d19">19</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d20">20</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d21">21</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d22">22</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d23">23</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d24">24</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d25">25</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d26">26</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d27">27</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d28">28</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d29">29</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d30">30</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="d31">31</th>
                                            <th style="border: 1px solid #000; padding: 8px;" id="Total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="attendanceBody">
                                        <tr style="background-color:white; border: 1px solid #000;">
                                            <th  style="border: 1px solid #000; padding: 12px; text-align:left;background:black; color:white" id="Department1">Department</th>
                                            <!-- <th colspan="32" style="border: 1px solid #000; padding: 12px;background-color:white; "></th> -->
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div style="display: flex;">
                                    <button onclick="toggleTables()" class="btn btn-danger" type="button" onclick="add()" style="margin-left: 10px;margin-top: auto;">Legend</button>

                                    <div id="tableContainer" class="table-container">
                                        <table id="legendTable" class="table">
                                            <thead>
                                                <tr class="table-header">
                                                    <th colspan="2">Shift Legend</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>I - shift</td>
                                                    <td>10:00am - 6/6:30pm</td>
                                                </tr>
                                                <tr>
                                                    <td>II - shift</td>
                                                    <td>x</td>
                                                </tr>
                                                <tr>
                                                    <td>III - shift</td>
                                                    <td>x</td>
                                                </tr>
                                                <tr>
                                                    <td>N - night shift</td>
                                                    <td>x</td>
                                                </tr>
                                                <tr>
                                                    <td>C - common shift</td>
                                                    <td>10am - 6pm</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: #D04617;">Week Off</td>
                                                    <td>Sunday</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table id="absenceLegendTable" class="table">
                                            <thead>
                                                <tr class="table-header">
                                                    <th colspan="6">Absence Legend</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>EL</td>
                                                    <td colspan="2">Earned Leave</td>
                                                    <td>PL</td>
                                                    <td colspan="2">Privieged Leave</td>
                                                </tr>
                                                <tr>
                                                    <td>SL</td>
                                                    <td colspan="2">Sick Leave</td>
                                                    <td>CasL</td>
                                                    <td colspan="2">Casual Leave</td>
                                                </tr>
                                                <tr>
                                                    <td>ML</td>
                                                    <td colspan="2">Maternity Leave</td>
                                                    <td>BL</td>
                                                    <td colspan="2">Bereavement Leave</td>
                                                </tr>
                                                <tr>
                                                    <td>CO</td>
                                                    <td colspan="2">Compensatory Off</td>
                                                    <td>LWP</td>
                                                    <td colspan="2">Leave Without Pay</td>
                                                </tr>
                                                <tr>
                                                    <td>SabL</td>
                                                    <td colspan="2">Sabbatical Leave</td>
                                                    <td>CL</td>
                                                    <td colspan="2">Childcare Leave</td>
                                                </tr>
                                                <tr>
                                                    <td>A</td>
                                                    <td colspan="5">Absent</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.16.0/prism.min.js" data-manual></script>
<script src="../Template/vendor/jquery/jquery.min.js"></script>
<script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../Template/js/popper.min.js"></script>
<script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="../js/source.js"></script>
<script src="../js/mock.js"></script>
<script src="../js/bootstrap-autocomplete.js"></script>
<script>
    // Fetch data and populate the datalist
    $(document).ready(function() {
        // Specify the URL for data prefetch
        var prefetchUrl = "SetFilters.php?filename=EmployeesFilter";

        // Fetch data from the server
        $.ajax({
            url: prefetchUrl,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate the datalist with fetched data
                var datalist = $('#list-employees');
                datalist.empty(); // Clear existing options
                if (data.status === 'success' && data.data) {
                    data.data.forEach(function(employee) {
                        datalist.append('<option value="' + employee.empidname + '">');
                    });
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });

        var prefetchUrl = "SetFilters.php?filename=DepartmentFilter";

        // Fetch data from the server
        $.ajax({
            url: prefetchUrl,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate the datalist with fetched data
                var datalist = $('#list-department');
                datalist.empty(); // Clear existing options
                if (data.status === 'success' && data.data) {
                    data.data.forEach(function(department) {
                        datalist.append('<option value="' + department.department_name + '">');
                    });
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });
</script>
<script>
    function GenerateRoster() {
        // Get values from input elements
        var selectedMonth = document.getElementById('date-datalist').value;
        var employeeElement = document.getElementById('employees-datalist');
        var nameElement = document.getElementById('name-datalist');
        var selectedEmployee = employeeElement ? employeeElement.value || null : null;

        // Check if the element exists before accessing its value
        var departmentElement = document.getElementById('department-datalist');
        var selectedDepartment = departmentElement ? departmentElement.value || null : null;

        // Parse the selected month to get the year and month
        var year = parseInt(selectedMonth.substring(0, 4));
        var month = parseInt(selectedMonth.substring(5, 7));
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var monthName = monthNames[month - 1];

        var startDateArray = [year, month.toString().padStart(2, '0'), '01'];
        var startDate = startDateArray.join('-');

        var lastDay = new Date(year, month, 0).getDate();
        var endDateArray = [year, month.toString().padStart(2, '0'), lastDay.toString().padStart(2, '0')];
        var endDate = endDateArray.join('-');

        var employeeParts = selectedEmployee ? selectedEmployee.split(' | ') : [null, null];
        var employeeCode = employeeParts[0];
        var employeeName = employeeParts[1];

        var data = {
            startDate: startDate,
            endDate: endDate,
            EmployeeCode: employeeCode,
            EmployeeName: employeeName,
            Department: selectedDepartment
        };

        $.ajax({
            url: 'GetRoasterData.php',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status === 'success') {
                    populateTable(response.data, selectedMonth);
                    markSundays(selectedMonth);
                    document.getElementById('Month').innerHTML = monthName;
                    document.getElementById('Year').innerHTML = year;
                    document.getElementById('absenceLegendTable').style.display = 'table';
                    document.getElementById('legendTable').style.display = 'table';
                    document.getElementById('RoasterPrint').style.display = 'block';
                    console.log(response);
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });

        // Display the results (you can modify this part based on your needs)
        console.log('Start Date:', startDate);
        console.log('End Date:', endDate);
        console.log('Selected Employee Code:', employeeCode);
        console.log('Selected Employee Name:', employeeName);
        console.log('Selected Department:', selectedDepartment);
    }

    function markSundays(selectedMonth) {
        var year = parseInt(selectedMonth.substring(0, 4));
        var month = parseInt(selectedMonth.substring(5, 7));

        var firstDay = new Date(year, month - 1, 1);
        var lastDay = new Date(year, month, 0);
        var numberOfDays = lastDay.getDate();

        // Hide columns if 30 days exist in the month or if the month is February (28 or 29 days)
        for (var day = 29; day <= 31; day++) {
            var thElement = document.getElementById("d" + day);

            if (day > numberOfDays) {
                if (thElement) {
                    thElement.style.display = "none";
                }
            } else {
                // Check if the column was previously hidden and make it visible
                if (thElement && thElement.style.display === "none") {
                    thElement.style.display = "";
                }
            }
        }

        for (var day = 1; day <= 31; day++) {
            var currentDate = new Date(year, month - 1, day);
            var thElement = document.getElementById("d" + day);

            // Revert to normal background color if day is not Sunday and color has already been changed
            if (thElement && currentDate.getDay() !== 0 && thElement.style.backgroundColor === "rgb(27, 27, 27)") {
                thElement.style.backgroundColor = "#DBDBDB"; // Revert to default background color
            }

            // Change background color to #C55A11 if day is Sunday
            if (currentDate.getDay() === 0 && currentDate >= firstDay && currentDate <= lastDay) {
                if (thElement) {
                    thElement.style.backgroundColor = "black";
                    thElement.style.color = "white";
                    
                }
            }
        }
    }


    function toggleOtherReason() {
        const abReason = document.getElementById("ab_reason").value;
        const otherContainer = document.getElementById("other-reason-container");

        if (abReason === "other") {
            otherContainer.style.display = "block";
        } else {
            otherContainer.style.display = "none";
            document.getElementById("other_reason").value = "";  // Clear custom reason if hidden
        }
    }


    // function populateTable(data, selectedMonth) {
    //     var tableBody = document.getElementById("attendanceBody");
    //     while (tableBody.firstChild) {
    //         tableBody.removeChild(tableBody.firstChild);
    //     }
    //     var year = parseInt(selectedMonth.substring(0, 4));
    //     var month = parseInt(selectedMonth.substring(5, 7));
    //     var lastDay = new Date(year, month, 0);
    //     var numberOfDays = lastDay.getDate();
    //     // Group data by department
    //     var groupedDataByDepartment = {};
    //     data.forEach(function(item) {
    //         if (!groupedDataByDepartment[item.department]) {
    //             groupedDataByDepartment[item.department] = [];
    //         }
    //         groupedDataByDepartment[item.department].push(item);
    //     });

    //     // Iterate over departments
    //     for (var department in groupedDataByDepartment) {
    //         if (groupedDataByDepartment.hasOwnProperty(department)) {
    //             // Create a row for each department
    //             var departmentRow = document.createElement("tr");
    //             var departmentCell = document.createElement("td");
    //             departmentCell.textContent = department;
    //             departmentCell.setAttribute("colspan", "35");
    //             departmentCell.style.textAlign = "left";
    //             departmentCell.style.fontWeight = "bold";
    //             departmentCell.style.backgroundColor = "#FFC000";
    //             departmentCell.style.padding = "7px";
    //             departmentCell.style.border = "1px solid #000";
    //             departmentRow.appendChild(departmentCell);
    //             tableBody.appendChild(departmentRow);

    //             // Group data by employee within the department
    //             var groupedDataByEmployee = {};
    //             groupedDataByDepartment[department].forEach(function(employee) {
    //                 if (!groupedDataByEmployee[employee.emp_name_id]) {
    //                     groupedDataByEmployee[employee.emp_name_id] = [];
    //                 }
    //                 groupedDataByEmployee[employee.emp_name_id].push(employee);
    //             });

    //             // Iterate over employees within the department
    //             for (var employeeId in groupedDataByEmployee) {
    //                 if (groupedDataByEmployee.hasOwnProperty(employeeId)) {
    //                     // Create a row for each employee
    //                     var employeeRow = document.createElement("tr");
    //                     var employeedeatils = document.createElement("td");
    //                     employeedeatils.textContent = employeeId;
    //                     employeedeatils.style.textAlign = "left";
    //                     //employeedeatils.style.fontWeight = "bold";
    //                     employeedeatils.style.border = "1px solid #000";
    //                     employeedeatils.style.padding = "6px";
    //                     employeedeatils.style.whiteSpace = "nowrap";
    //                     employeeRow.appendChild(employeedeatils);
    //                     //Create Start Time Row
    //                     var startTimeRow = document.createElement("tr");
    //                     var startTimeCell = document.createElement("td");
    //                     startTimeCell.textContent = "Start Time ";
    //                     startTimeCell.style.textAlign = "center";
    //                     //startTimeCell.style.fontWeight = "bold";
    //                     startTimeCell.style.backgroundColor = "#DBDBDB";
    //                     startTimeCell.style.border = "1px solid #000";
    //                     startTimeCell.style.padding = "6px";
    //                     startTimeRow.appendChild(startTimeCell);
    //                     //tableBody.appendChild(startTimeRow);
    //                     // Populate cells for each day (1 to 31)
    //                     for (var day = 1; day <= numberOfDays; day++) {
    //                         var dayCell = document.createElement("td");
    //                         dayCell.style.border = "1px solid #000";
    //                         dayCell.style.textAlign = "center";
    //                         dayCell.style.padding = "4px";
    //                         dayCell.textContent = "";
    //                         //Start Time Cell
    //                         var startTimeCell = document.createElement("td");
    //                         startTimeCell.style.textAlign = "center";
    //                         // startTimeCell.style.fontWeight = "bold";
    //                         startTimeCell.style.backgroundColor = "#DBDBDB";
    //                         startTimeCell.style.border = "1px solid #000";
    //                         startTimeCell.style.padding = "4px";

    //                         // Iterate over attendance records for the employee
    //                         groupedDataByEmployee[employeeId].forEach(function(employee) {
    //                             var dateObject = new Date(employee.attendance_date);
    //                             var dayOfMonth = dateObject.getDate();

    //                             // Check if the attendance date matches the current day
    //                             if (dayOfMonth == day) {
    //                                 startTimeCell.textContent = employee.start_time;
    //                                 dayCell.textContent = employee.attendance ;

                                

    //                             }
    //                         });

    //                         // Append the cell to the employee row
    //                         employeeRow.appendChild(dayCell);
    //                         //Append Cell to the StartTime ROw
    //                         startTimeRow.appendChild(startTimeCell);
    //                     }
    //                     var totalcell = document.createElement("td");
    //                     totalcell.textContent = "X %";
    //                     totalcell.style.textAlign = "center";
    //                     totalcell.style.border = "1px solid #000";
    //                     employeeRow.appendChild(totalcell);
    //                     var startimetotalcell = document.createElement("td");
    //                     startimetotalcell.style.backgroundColor = "#DBDBDB";
    //                     startimetotalcell.style.border = "1px solid #000";
    //                     startTimeRow.appendChild(startimetotalcell);

    //                     // Append the employee row to the table body
    //                     tableBody.appendChild(employeeRow);
    //                     tableBody.appendChild(startTimeRow);
    //                 }
    //             }
    //         }
    //     }
    // }
    function populateTable(data, selectedMonth) {
    var tableBody = document.getElementById("attendanceBody");
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }

    var year = parseInt(selectedMonth.substring(0, 4));
    var month = parseInt(selectedMonth.substring(5, 7));
    var lastDay = new Date(year, month, 0).getDate();

    var groupedDataByDepartment = {};
    data.forEach(item => {
        if (!groupedDataByDepartment[item.department_name]) {
            groupedDataByDepartment[item.department_name] = [];
        }
        groupedDataByDepartment[item.department_name].push(item);
    });

    for (var department in groupedDataByDepartment) {
        if (groupedDataByDepartment.hasOwnProperty(department)) {
            var departmentRow = document.createElement("tr");
            var departmentCell = document.createElement("td");
            departmentCell.textContent = department;
            // departmentCell.setAttribute("colspan", lastDay + 2);
            departmentCell.style = "text-align:left;font-weight:bold;color:#FFFFFF;background:black;padding:7px;border:1px solid #000;";
            departmentRow.appendChild(departmentCell);
            tableBody.appendChild(departmentRow);

            var groupedDataByEmployee = {};
            groupedDataByDepartment[department].forEach(employee => {
                if (!groupedDataByEmployee[employee.emp_id]) {
                    groupedDataByEmployee[employee.emp_id] = [];
                }
                groupedDataByEmployee[employee.emp_id].push(employee);
            });

            for (var empId in groupedDataByEmployee) {
                if (groupedDataByEmployee.hasOwnProperty(empId)) {
                    var employeeRow = document.createElement("tr");
                    var empDetails = document.createElement("td");
                    empDetails.textContent = `${groupedDataByEmployee[empId][0].emp_id} | ${groupedDataByEmployee[empId][0].name}`;

                    empDetails.style = "text-align:left;font-weight:bold;border:1px solid #000;padding:6px;white-space:nowrap;";
                    employeeRow.appendChild(empDetails);

                    var startTimeRow = document.createElement("tr");
                    var startTimeHeaderCell = document.createElement("td");
                    startTimeHeaderCell.textContent = "Start Time";
                    startTimeHeaderCell.style = "text-align:center;font-weight:bold;background:white;border:1px solid #000;padding:6px;";
                    startTimeRow.appendChild(startTimeHeaderCell);

                    let totalDaysPresent = 0;
                    let totalDays = 0; // Exclude Sundays from total count

                    for (var day = 1; day <= lastDay; day++) {
                        var currentDate = new Date(year, month - 1, day);
                        var isSunday = currentDate.getDay() === 0;

                        var dayCell = document.createElement("td");
                        dayCell.style = "border:1px solid #000;text-align:center;padding:4px;";
                        if (isSunday) {
                            dayCell.style.backgroundColor = "black"; // Color Sundays
                            
                        }

                        var startTimeCell = document.createElement("td");
                        startTimeCell.style = "text-align: center; background: white; border: 1px solid #000; padding: 4px; ";

                        // startTimeCell.textContent = "--";

                        let attendanceValue = "A"; // Default is Absent

                        groupedDataByEmployee[empId].forEach(employee => {
                            var dateObject = new Date(employee.attendance_date);
                            if (dateObject.getDate() == day) {
                                // ✅ Format `opening_time` to HH:MM only
                                let time = employee.opening_time || "--";
                                if (time !== "--") {
                                    let [hours, minutes] = time.split(":");   // Extract hours and minutes
                                    time = `${hours}:${minutes}`;             // Display in HH:MM format
                                }
                                startTimeCell.textContent = time;

                                var attendanceCell = document.createElement("span");

                                // Mapping reasons to their abbreviations
                                const paidreasonMap = {
                                    "Earned Leave": "EL",
                                    "Privieged Leave": "PL",
                                    "Sick Leave" : "SL",
                                    "Casual Leave": "CasL",
                                    "Maternity Leave": "ML",
                                    "Bereavement Leave": "BL",
                                    "Compensatory Off": "CL"
                                };

                                const unpaidreasonMap = {
                                    "Leave Without Pay": "LWP",
                                    "Sabbatical Leave": "SabL",
                                    "Childcare Leave": "CL",
                                };

                                let abReason = employee.ab_reason ? employee.ab_reason.trim() : "";

                                if (!abReason || abReason === "") {
                                    attendanceValue = "P"; // No reason → Present
                                    totalDaysPresent++;
                                } else if (paidreasonMap.hasOwnProperty(abReason)) {
                                    attendanceValue =  "P";      // Present for paid reasons
                                    totalDaysPresent++;

                                    attendanceCell.style.backgroundColor = "yellow";
                                    attendanceCell.style.paddingTop = "6px";   
                                    attendanceCell.style.paddingBottom = "6px"; 
                                    attendanceCell.style.paddingLeft = "14px";  
                                    attendanceCell.style.paddingRight = "14px";

                                    attendanceCell.addEventListener("mouseover", () => {
                                        showPopup(`${abReason}`);  // Display custom popup
                                    });

                                    attendanceCell.addEventListener("mouseleave", () => {
                                        closePopup();
                                    });
                                } else if (unpaidreasonMap.hasOwnProperty(abReason)) {
                                    attendanceValue = "A";         // Absent for unpaid reasons
                                } else {
                                    attendanceValue = "A"; // Other reasons → Absent
                                }

                                attendanceCell.textContent = attendanceValue;
                                attendanceCell.className = "attendance-cell";
                                attendanceCell.dataset.attendanceDate = employee.attendance_date;

                                if (attendanceValue === "A") {
                                    attendanceCell.classList.add("absent");

                                    // Add event listener for hover to show the popup
                                    attendanceCell.addEventListener("mouseover", function () {
                                        fetchAttendanceReason(employee.attendance_date).then(reason => {
                                            showPopup(reason);
                                        });
                                    });
                                }

                                attendanceCell.addEventListener("mouseleave", function () {
                                    closePopup();
                                });

                                dayCell.appendChild(attendanceCell);
                            }
                        });

                        employeeRow.appendChild(dayCell);
                        startTimeRow.appendChild(startTimeCell);

                        // Only count non-Sundays in totalDays for percentage calculation
                        if (!isSunday) {
                            totalDays++;
                        }
                    }

                    // Calculate Attendance Percentage (excluding Sundays)
                    let attendancePercentage = totalDays > 0 ? ((totalDaysPresent / totalDays) * 100).toFixed(2) + "%" : "N/A";

                    var totalCell = document.createElement("td");
                    totalCell.textContent = attendancePercentage; // Display calculated percentage
                    totalCell.style = "text-align:center;border:1px solid #000;";
                    employeeRow.appendChild(totalCell);

                    var startTimeTotalCell = document.createElement("td");
                    startTimeTotalCell.style = "background:#DBDBDB;border:1px solid #000;";
                    startTimeRow.appendChild(startTimeTotalCell);

                    tableBody.appendChild(employeeRow);
                    tableBody.appendChild(startTimeRow);
                }
            }
        }
    }
}




function showPopup(reason) {
    var popup = document.getElementById('popup');
    var popupContent = document.getElementById('popup-content');
    popupContent.textContent = reason;
    popup.style.display = 'block';
}

function closePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}

function fetchAttendanceReason(attendanceDate) {
    const url = `./getAttendanceReason.php?date=${encodeURIComponent(attendanceDate)}`;
    return fetch(url)
        .then(response => response.json())
        .then(data => data.reason || 'No reason available');
        // console.log(x);
        // return x;
}

function showTooltip(element, reason) {
    var tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = reason;

    document.body.appendChild(tooltip);

    var rect = element.getBoundingClientRect();
    tooltip.style.position = 'absolute';
    tooltip.style.left = rect.left + 'px';
    tooltip.style.top = rect.bottom + 'px';
    
    element.addEventListener('mouseout', function() {
        document.body.removeChild(tooltip);
    });
}

</script>
<style>
.tooltip {
    background-color: #333;
    color: #fff;
    padding: 5px;
    border-radius: 4px;
    font-size: 12px;
    z-index: 1000;
}
.absent {
    cursor: pointer;
}

</style>
<script>
    function printData() {
        // Open a new window for printing
        var printWindow = window.open('', '_blank');

        // Add the HTML content to the new window
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<link rel="stylesheet" type="text/css" href="print.css" media="print">');
        printWindow.document.write('</head><body>');
        printWindow.document.write(document.getElementById('RoasterData').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Trigger the print dialog
        printWindow.print();
    }
</script>

<!-- abbreviation script -->
<script>
    function toggleTables() {
        var container = document.getElementById('tableContainer');
        if (container.style.display === 'none' || container.style.display === '') {
            container.style.display = 'flex';
        } else {
            container.style.display = 'none';
        }
    }
</script>

<!-- ajax add btn script  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('addButton');
        if (addButton) {
            addButton.addEventListener('click', function() {
                const empId = document.getElementById('employee').value;
                const startDate = document.getElementById('startDate').value;
                const days = document.getElementById('days').value;
                const department = document.getElementById('department').value;

                // Check if all elements are found
                if (empId === undefined || startDate === undefined || days === undefined || department === undefined) {
                    console.error('One or more elements not found in the DOM');
                    return;
                }

                // Perform an AJAX call to the backend script
                fetch('/path/to/backend/script', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            empId,
                            startDate,
                            days,
                            department
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update the roaster with the new data
                        console.log(data);
                        // Logic to update the frontend roaster
                    })
                    .catch(error => console.error('Error:', error));
            });
        } else {
            console.error('Add button not found in the DOM');
        }
    });
</script>

<script>
    $(document).ready(function(){
    // Trigger form submission when the Add Date button is clicked
    $("#addDateButton").on("click", function(event){
        event.preventDefault(); // Prevent default button behavior (like submitting a form)

        // Manually trigger the form submission
        $("#searchForm").submit();
    });

    // Handle the form submit event
    $("#searchForm").on("submit", function(event){
        event.preventDefault(); // Prevent default form submission

        // Perform an AJAX call to send form data
        $.ajax({
            url: "add_absence.php", // URL to your PHP file
            method: "POST",
            data: $(this).serialize(), // Serialize form data for submission
            success: function(response){
                $("#result").html(response); // Display the server's response in the result element
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown); // Log errors if any occur
            }
        });
    });
});

    $(document).ready(function(){
    // When the Add Days button is clicked
    $("#addButton").on("click", function(event){
        event.preventDefault(); // Prevent default button action

        // Manually trigger form submission
        $("#searchForm").submit();
    });

    // When the form is submitted
    $("#searchForm").on("submit", function(event){
        event.preventDefault(); // Prevent default form submission

        // Make an AJAX call to send form data
        $.ajax({
            url: "add_employee_task.php", // Your PHP file
            method: "POST",
            data: $(this).serialize(), // Serialize form data
            success: function(response){
                $("#result").html(response); // Display response in result element
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown); // Log errors if any
            }
        });
    });
});

</script>

<!-- ab reason script  -->
<!-- <script>
    /* script.js */
    document.addEventListener("DOMContentLoaded", () => {
        const tooltip = document.getElementById("tooltip");
        const absentDays = document.querySelectorAll("[data-absent-reason]");

        absentDays.forEach(day => {
            day.addEventListener("mouseenter", (event) => {
                const reason = event.target.getAttribute("data-absent-reason");
                tooltip.textContent = reason;
                tooltip.style.left = `${event.pageX + 5}px`;
                tooltip.style.top = `${event.pageY + 5}px`;
                tooltip.classList.add("tooltip-visible");
            });

            day.addEventListener("mouseleave", () => {
                tooltip.classList.remove("tooltip-visible");
            });
        });
    });
</script> -->

</html>