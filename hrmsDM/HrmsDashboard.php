<?php
session_start();
if (!isset($_SESSION["HRLoginId"])) {
    header("location: ../login.php");  // Redirect to HR login page
    exit();
}

require("../formconnection.php");

// Get HR ID from session
$emp_id = $_SESSION["HRLoginId"];

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <title>HRMS Dashboard</title>
    <style>
        .submenu {
            display: none;
            position: relative;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .submenu li {
            display: block;
        }

        .submenu li a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }

        .submenu li a:hover {
            background-color: #f0f0f0;
        }

        a:hover + .submenu, .submenu:hover {
            display: block;
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
            <a href="">
                <i class='bx bxs-dashboard'></i>
                <span class="text">HRMS Dashboard</span>
            </a>
        </li>
        <li class="has-submenu">
            <a href="login.html">
                <i class='bx bxs-megaphone'></i>
                <span class="text">HR Login</span>
            </a>
        </li>
        
    
        <li>
            <a href="../HRMS/Employee/EmployeeTasks/EmployeeTasksListing.php?emp_id=<?php echo urlencode($emp_id); ?>">
                <span class="text" style="text-align: center;padding-left: 20px;">HR Listing</span>
            </a>
        </li>

        <li>
            <a href="../HRMS/Employee/EmployeeListing.php">
                <span class="text" style="text-align: center;padding-left: 20px;">Employee Task</span>
            </a>
        </li>

        <li>
            <a href="./EmployeeRoaster/EmployeesRoaster.php">
                <span class="text" style="text-align: center;padding-left: 20px;">Roaster Management</span>
            </a>
        </li>

        <li>
            <a href="./Date_Of_Joining/DojListing.php">
                <span class="text" style="text-align: center;padding-left: 20px;">DOJ</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Search here</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <div class="logout-btn">
            <form method="post" action="">
                <input style="font-family: 'Cooper', sans-serif; color: white; background-color:#8e0c0c; padding: 10px 20px; cursor: pointer; font-style: normal; border: none;" 
                       type="submit" name="logout" value="Logout">
            </form>
        </div>
        <a href="#" class="profile"></a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>HRMS Dashboard</h1>
                <h3>Welcome HR: <strong><?php echo htmlspecialchars($emp_id); ?></strong></h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="#" href="#">Home</a>
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
                    </span>
                </li>
                <li>
                    <i class='bx bxs-calendar-check'></i>
                    <span class="text">
                        <h3><a href="dddd.htm">Project-2</a></h3>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-calendar-check'></i>
                    <span class="text">
                        <h3><a href="./home.html">Project-3</a></h3>
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
