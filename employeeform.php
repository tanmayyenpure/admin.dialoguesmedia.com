<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link href="Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <title>Employee Form</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="img/apple-touch-icon.png" alt="">
            <span class="text">Dialoguesmedia</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#">
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
                    <label for="department_name">Department Name</label>
                    <input type="text" placeholder="Department Name" id="department_name" class="form-control" name="department_name">
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
    </section>
    <!-- CONTENT -->
    <?php
   function getNextEmployeeCode() 
   {
       // Read the query from the text file
       $queryFilePath = 'GetMaxCode.txt';
       $query = file_get_contents($queryFilePath);
   
       include 'formconnection.php'; // Include your database connection file
   
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
                document.getElementById('department_name').value = '{$employeeData['data']['department_name']}';
                document.getElementById('job_role').value = '{$employeeData['data']['job_role']}';
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
                    }
                    else
                    {
                        alert("error :- " + response.message); 
                    }
                }
            };

            xhr.send(formData);
     }
</script>
</html>

