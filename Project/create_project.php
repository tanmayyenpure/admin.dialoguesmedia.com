<?php
// Include the connection file
require_once '../formconnection.php';

$message = ""; // Initialize a variable to hold the message

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data

    $projectName = $_POST['project-name'] ?? null;
    $projectDescription = $_POST['project-description'] ?? null;
    $startDate = $_POST['start-date'] ?? null;
    $endDate = $_POST['end-date'] ?? null;
    $department_type = $_POST['department_type']?? null;
    $address = $_POST['address'] ?? null;

    // Check if the form data is valid
    if ($projectName && $projectDescription && $startDate && $endDate && $department_type && $address) {
        // Sanitize form data
        $projectName = mysqli_real_escape_string($conn, $projectName);
        $projectDescription = mysqli_real_escape_string($conn, $projectDescription);
        $startDate = mysqli_real_escape_string($conn, $startDate);
        $endDate = mysqli_real_escape_string($conn, $endDate);
        $department_type = mysqli_real_escape_string($conn, $department_type);
        $address = mysqli_real_escape_string($conn, $address);

        // Insert the form data into the Project table
        $sql = "INSERT INTO Project (Pname , Description, start_date , end_date ,department_type ,address)
                VALUES ('$projectName', '$projectDescription', '$startDate', '$endDate','$department_type', '$address')";
        
        if (!mysqli_query($conn, $sql)) {
            $message = "Error inserting data: " . mysqli_error($conn);
        } else {
            $message = "Project created successfully!";
        }
    } else {
        $message = "Invalid form data";
    }
}

// Check if the connection is valid before trying to close it
if (isset($conn) && $conn) {
    // Close the connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Form</title>
    <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 5px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            width: 300px;
            margin: 20px auto;
            text-align: center;
            font-size: 1.2em;
            color: red;
        }
        
    .bg-maroon {
        background-color: #AA0000 !important;
    }

        .btn-custom {
        background-color: #AA0000;
        border-color: #AA0000;
        color: white; /* Set text color to white */
        text-align: center; /* Align text at the center */
        padding: 8px 16px; /* Adjust padding as needed */
    }
    .btn-custom:hover {
        background-color: #990000;
        border-color: #990000;
    }
    .btn-container {
            text-align: center;
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
    <br>
     <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-maroon text-white">
                <h6 class="m-0 font-weight-bold">Create a new Project</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="project-name">Project Name:</label>
                        <input type="text" class="form-control" id="project-name" name="project-name" required>
                    </div>

                    <div class="form-group">
                        <label for="project-description">Project Description:</label>
                        <textarea class="form-control" id="project-description" name="project-description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="start-date">Start Date:</label>
                        <input type="date" class="form-control" id="start-date" name="start-date" required>
                    </div>

                    <div class="form-group">
                        <label for="end-date">End Date:</label>
                        <input type="date" class="form-control" id="end-date" name="end-date" required>
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
                    
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="btn-container">
                    <button type="submit" class="btn btn-custom">Submit</button>
                    </div>
                </form>
                <div class="message"><?php echo $message; ?></div>
            </div>
        </div>
    </div>
</body>
</body>
</html>
