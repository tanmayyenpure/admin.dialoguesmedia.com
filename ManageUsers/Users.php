<?php
// session_start();
// if (!isset($_SESSION["AdminLoginId"])) {
//     header("location: ../AdminLogin.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <title>Manage Users</title>
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



        /* Internal CSS to override sidebar styles */
        #sidebar {
            background-color: #8e0c0c !important;
        }
        /* #sidebar .side-menu li a {
            color: #fff !important;
            background-color: transparent !important;
            border: none !important;
        } */
        #sidebar .side-menu li.active a,
        #sidebar .side-menu li a:hover {
            background-color: #fff !important;
            color: #8e0c0c !important;
        }
        
        #sidebar .brand img {
            width: 30px;
            height: auto;
        }
        .text-danger {
            color: #8e0c0c !important;
        }
        .btn-danger {
            background-color: #8e0c0c !important;
            border-color: #8e0c0c !important;
        }

     
        .table-header {
            background-color: #8e0c0c !important;
            color: #fff !important;
        }
        
        .card-header .btn-danger:first-child {
            margin-right: 10px;
        }
        
        /* Button container */
.btnaction {
    display: inline-flex;
    align-items: center;      /* Center content vertically */
    justify-content: center;  /* Center content horizontally */
    font-size: 14px;          /* Smaller text size */
    padding: 0;               /* Remove extra padding */
     border:none;    
    background: transparent;  /* Transparent background */
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    overflow: hidden;     
    border-radius:5px;    /* Prevent image overflow */
}

/* Icon inside the button */
.btnaction img {
    height: 20px;             /* Icon size */
    width: 20px;              /* Icon size */
    object-fit: contain;      /* Fit the image within the button */
}

/* Edit button styling */
.edit-btn {
    height: 40px;             /* Same height as other buttons */
    width: 80px;              /* Same width as other buttons */
    border: 1px solid black;
    display: inline-flex;
    align-items: center;  
    justify-content: center; 
    transition: 0.3s;   
    font-size:18px;
    margin-left:10px;
    background:white;
}

.edit-btn img{
    margin-left:-10px;
}

.edit-btn span{
    margin-left:-18px;
}

/* Hover effect */
.btnaction:hover {
    transform: scale(1.1);    /* Slight scale effect */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Hover color effects */
.edit-btn:hover {
    border-color: #4CAF50;    /* Green border on hover */
}

.delete-btn:hover {
    border-color: #f44336;    /* Red border on hover */
}

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

        
        .btn-container {
			/* position: fixed; */
			bottom: 20px;
			margin-bottom: 50px;
            margin-top:50px;
			/* Adjust this value as needed */
		}

		.btnhrms {
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
        <li >
				<a href="../Dashboard/AdminDashboard.php">
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
						<a href="../../Dashboard/MarketingProjects.php">
							<span class="text" style="text-align: center;padding-left: 20px;">My Projects</span>
						</a>
					</li>
					<!-- Submenu item for New Project -->
					<li>
						<a href="../../Project/ProjectListing.php">
							<span class="text" style="text-align: center;padding-left: 20px;">New Project</span>
						</a>
					</li>
				</ul>
            </li>
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
				<li ><a href="../HRMS/HR/HRListing.php">
					<span class="text" style="text-align: center;padding-left: 20px;">HR Listing</span>
				</a></li>
                <li class="active"><a href="Users.php">
					<span class="text" style="text-align: center;padding-left: 20px;">Manage User</span>
				</a></li>

                <div class="btn-container">
			<a href="../HrmsDashboard.php" class="btnhrms" style="left: 87px; position: relative;">
				<span class="text" style="text-align: center;padding-left: 0px; top: 0px;position:relative;color:white;">HRMS</span>
			</a>
		</div>
    </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <a href="#" class="profile">
                <!-- Add profile image or icon if needed -->
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-danger fs-15">Manage Users</h6>
                        <div class="d-flex">
                            <a href="./ChangePassword.php" class="btn btn-danger btn-sm me-2">Change Password</a>
                            <a href="./CreateUser.php" class="btn btn-danger btn-sm">Create User</a>
                        </div>
                    </div>
                    <div class="card-body" style="width: 100%;  white-space: nowrap;">
                        <div class="table-responsive" style="min-width: 100px;"> <!-- Ensures scrollbar appears -->
                            <table class="table table-bordered" id="usersTable" style="width: 80%; min-width: 1200px; border-collapse: collapse;" cellspacing="0">
                                <thead>
                                    <tr class="table-header" style="text-align:center">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Access</th>
                                        <th >Page Access</th>
                                        <th>Last Login</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- User data will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function () {
    // Function to load users
    function loadUsers() {
        $.ajax({
            url: 'get_users.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    var tbody = $('#usersTable tbody');
                    tbody.empty();
                    $.each(response.data, function (i, user) {
                        var row = `<tr style="border: none; border-bottom:1px solid #EEEEEE">
                            <td style="border: none;">${user.name}</td>
                            <td style="border: none;">${user.username}</td>
                            <td style="border: none;">${user.role}</td>
                            <td style="border: none;">${user.access}</td>
                            <td style="border: none;">${user.page_access}</td>
                            <td style="border: none;"> ${user.current_date_time}</td>
                            <td style="border: none;">
                             <div style="display: inline-flex; align-items: center; gap: 10px; margin-top: -15px;">
                             <button class="btnaction edit-btn" 
                                        onclick="location.href='UpdateUser.php?uid=${user.uid}'">
                                        <img src="../img/edit.png" alt="Edit"> 
                                        <span>Edit</span>
                                    </button>
                                <button class="btnaction delete-btn" data-uid="${user.uid}">
                                    <img src="../img/delete.png" alt="Delete"> 
                                </button>
                            </div>
                            </td>
                          
                        </tr>`;
                        tbody.append(row);
                    });
                } else {
                    console.error('Error fetching users:', response.message);
                }
            },
            error: function () {
                console.error('AJAX error when fetching users');
            }
        });
    }

    // Load users when the page is ready
    loadUsers();

    // Refresh the list every 30 seconds
    setInterval(loadUsers, 30000);

    // Function to delete a user by uid
    $(document).on('click', '.delete-btn', function () {
        var uid = $(this).data('uid');

        if (confirm(`Are you sure you want to delete user with UID: ${uid}?`)) {
            $.ajax({
                url: 'delete_user.php', // Backend handler
                type: 'POST',
                data: { uid: uid },    // Sending UID to server
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert('User deleted successfully.');
                        loadUsers();    // Refresh the table after deletion
                    } else {
                        alert('Failed to delete user: ' + response.message);
                    }
                },
                error: function () {
                    alert('AJAX error while deleting user.');
                }
            });
        }
    });
});


    
    </script>
</body>

</html>
