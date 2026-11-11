<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    echo"<script>console.log('Emp id not given');</script>";
    header("location: ../login.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOJ Listing</title>
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="../Template/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <style type="text/css">
    /* Table styles */
    .tg  {
        border-collapse: collapse;
        border-spacing: 0;
        /* border-color: black;
        border-style: solid; */
        border-width: 1px;
    }

    /* Table cell styles */
    .tg td {
        /* border-color: black;
        border-style: solid; */
        padding-bottom:10px;
      border-bottom: 1px solid rgb(209, 207, 207);
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        word-break: normal;
    }

    /* Table header styles */
    .tg th {
        /* border-color: black;
        border-style: solid; */
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        word-break: normal;
    }

    /* Styling for specific cells with class tg-4ed6 */
    .tg .tg-4ed6 {
        background-color: black;
        border-color: inherit;
        color: white;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
    .tg .tg-4az1
    {
        background-color:white;
        text-align:center;
        vertical-align:middle;
    }
    .doj-form-row {
        background-color: #D6E3BC;
        text-align: center;
        
    }

    .doj-form-row td input {
        background-color: #D6E3BC;
        text-align: center;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal; /* Adjust as needed */
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
            <a href="../EmployeeTasks/EmployeeTasksListing?emp_id=<?php echo $_SESSION['emp_id']?>">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
            <?php
                // Check if the employee type is set in the session
                if (isset($_SESSION['type'])) {
                    $employeeType = $_SESSION['type'];

                    // Check if the employee type is 2
                    if ($employeeType == 2) {
                        echo '<a href="../EmployeeRoaster/EmployeeRoaster.php">
                                <i class="bx bxs-people"></i>
                                <span class="text">Attendance Roaster</span>
                            </a>';
                    } 
                } else {
                    header("location: ../login.html");
                }
                ?>
            </li>
            <li>
            <?php
                // Check if the employee type is set in the session
                if (isset($_SESSION['type'])) {
                    $employeeType = $_SESSION['type'];

                    // Check if the employee type is 2
                    if ($employeeType == 2) {
                        echo '<a href="../Employee/EmployeeListing.php">
                                <i class="bx bxs-people"></i>
                                <span class="text">Employee</span>
                            </a>';
                    } 
                } else {
                    header("location: ../login.html");
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
            <i class='bx bx-menu' ></i>
            <!-- <a href="#" class="nav-link">Search here</a> -->
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
             <!-- Page Wrapper -->
        <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger fs-15">Date Of Joining List</h6>
                    <div class="d-flex">
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-info-circle mr-1"></i> Info
                    </button>
                    <!-- Save Icon Button -->
                    <button type="button" class="btn btn-danger ml-2" onclick="CreateNew()">
                        <i class="fas fa-plus"></i> Add
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="tg" style="table-layout: fixed; width: 2375px" id="DojTable">
                        <colgroup>
                        <col style="width: 78.2px"> 
                        <col style="width: 180.2px">
                        <col style="width: 386.2px">
                        <col style="width: 129.2px">
                        <col style="width: 200.2px">
                        <col style="width: 110.2px">
                        <col style="width: 76.2px">
                        <col style="width: 270.2px">
                        <col style="width: 80.2px">
                        <col style="width: 70.2px">
                        <col style="width: 70.2px">
                        <col style="width: 85.2px">
                        <col style="width: 50.2px">
                        <col style="width: 50.2px">
                        <col style="width: 80.2px">
                        <col style="width: 109.2px">
                        <col style="width: 74.2px">
                        <col style="width: 131.2px">
                        <col style="width: 116.2px">
                        <col style="width: 130.2px">
                        <col style="width: 180.2px">
                        <col style="width: 110.2px">
                        <col style="width: 200.2px">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="tg-4ed6" rowspan="2">Sr. No.</th>
                            <th class="tg-4ed6" rowspan="2">Name</th>
                            <th class="tg-4ed6" rowspan="2">College Name</th>
                            <th class="tg-4ed6" rowspan="2">Location </th>
                            <th class="tg-4ed6" rowspan="2">E-mail Id</th>
                            <th class="tg-4ed6" rowspan="2">Contact No.</th>
                            <!-- <th class="tg-4ed6" rowspan="2">Domain</th> -->
                            <th class="tg-4ed6" rowspan="2">Department</th>
                            <th class="tg-4ed6" rowspan="2">Date Of Joining</th>
                            <th class="tg-4ed6" rowspan="2">Duration</th>
                            <th class="tg-4ed6" colspan="2">    Joining Formailites                   </th>
                            <th class="tg-4ed6"rowspan="2">Create Employee</th>
                            <th class="tg-4ed6" colspan="4">Leaving Formalities</th>
                            <th class="tg-4ed6" colspan="3">Completion Certificate</th>
                            <th class="tg-4ed6" rowspan="2">Batch(Session)</th>
                            <th class="tg-4ed6" rowspan="2">TPO Name</th>
                            <th class="tg-4ed6" rowspan="2">Contact No.</th>
                            <th class="tg-4ed6" rowspan="2">E-mail ID</th> 
                            <!-- 23 -->
                        </tr>
                        <tr>
                            <th class="tg-4ed6">EJM(AF)</th>
                            <th class="tg-4ed6">OL(IA)</th>
                            <th class="tg-4ed6">SOD</th>
                            <th class="tg-4ed6">Video</th>
                            <th class="tg-4ed6">Review(LI)</th>
                            <th class="tg-4ed6">Feedback Form</th>
                            <th class="tg-4ed6">Certificate</th>
                            <th class="tg-4ed6">Recommandation Letter</th>
                            <th class="tg-4ed6">Application Letter</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="doj-form-row">
                            <form id="dojform">
                                <td id="SrNo"> Sr No</td>
                                <td> <input type="text" class="form-control" id="name" name="name" placeholder="Name *" required> </td>
                                <td> <input type="text" class="form-control" id="college" name="college" placeholder="College *" required> </td>
                                <td> <input type="text" class="form-control" id="location" name="location" placeholder="Location *" required> </td>
                                <td> <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required> </td>
                                <td> <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile *" maxlength="15"required> </td>
                                <td> <input type="text" class="form-control" id="department" name="department" placeholder="department *" required> </td>
                                <td> <input type="date" class="form-control" id="doj" name="doj" placeholder="Date of Joining" > </td>
                                <td> <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" required> </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="ejm" name="ejm">
                                        <label class="custom-control-label" for="ejm"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="ol" name="ol">
                                        <label class="custom-control-label" for="ol"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_employee" name="is_employee">
                                        <label class="custom-control-label" for="is_employee"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sod" name="sod">
                                        <label class="custom-control-label" for="sod"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="video" name="video">
                                        <label class="custom-control-label" for="video"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="review" name="review">
                                        <label class="custom-control-label" for="review"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="feedback_form" name="feedback_form">
                                        <label class="custom-control-label" for="feedback_form"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="certificate" name="certificate">
                                        <label class="custom-control-label" for="certificate"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="recommendation_letter" name="recommendation_letter">
                                        <label class="custom-control-label" for="recommendation_letter"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="app_letter" name="app_letter">
                                        <label class="custom-control-label" for="app_letter"></label>
                                    </div>
                                </td>
                                <td> <input type="text" class="form-control" id="batch" name="batch" placeholder="Batch" > </td>
                                <td> <input type="text" class="form-control" id="tpo" name="tpo" placeholder="TPO" > </td>
                                <td> <input type="text" class="form-control" id="tpo_contact" name="tpo_contact" placeholder="TPO Contact" > </td>
                                <td> <input type="text" class="form-control" id="tpo_email" name="tpo_email" placeholder="TPO Email" > </td>
                                <!-- <td> <button type="button" > Save </button>
                                <td> <button type="button" > Delete </button> -->
                            </form>
                        </tr>     
                        <?php
                        include "table2.php"                 
                        ?>   
                        </tbody>
                    </table>
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
 <script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../Template/js/popper.min.js"></script>
    <script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../Template/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script>
      function handleCheckboxChange(checkbox) {
        if(!window.confirm("Confirm Update field?")){
          checkbox.checked = (checkbox.getAttribute("data-initial-value") == '1') ? 'checked' : '';
          return;
        }
        var id = checkbox.id; // Retrieve the ID from the checkbox
        var value = checkbox.checked ? 1 : 0; // Get the new value (1 if checked, 0 if unchecked)
        var dojId = checkbox.getAttribute('data-dojid');
        var name = checkbox.getAttribute('data-boolkey');
    
    console.log("DOJ_ID: " + dojId + ", BoolKey: " + name);
        // Print the values to the console
        console.log("ID: " + id + ", Value: " + value);
        if (name == 'is_employee'&& value == 1)
        {
            console.log("Creating Employee...");
            CreatEmployee();
        }
        else if(name != 'is_employee' || (name == 'is_employee'&& value == 1) )
        {
        $.ajax({
                url: 'update_doj.php',
                method: 'POST',
                data: {
                    id: dojId,
                    name: name,
                    value: value,
                },
                success: function (response) {
                    // Handle the response if needed
                    
                    if (response.status === 'success') {
                        console.log(response.message);
                    
                } else {
                    alert('Error: ' + response.message);
                }
                }
            });
        }
                
        else
        {
            checkbox.checked = true;
            alert('Cannot Change Employee Already Created');
        }
        // You can now send the values to the server using AJAX or perform any other actions as needed.
    }
    function handleFocus(element) {
        element.dataset.originalValue = element.innerText.trim();
    }

    // Handle blur event
    function handleBlur(element) {
        const id = element.dataset.id;
        const name = element.dataset.name;
        const value = element.innerText.trim();
        const originalValue = element.dataset.originalValue;

        // Check if the value has changed
        if (value !== originalValue) {
            // Send the updated data to your PHP script (update_doj.php)
            $.ajax({
                url: 'update_doj.php',
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                    value: value,
                },
                success: function (response) {
                    // Handle the response if needed
                    
                    if (response.status === 'success') {
                        console.log(response.message);
                    
                } else {
                    alert('Error: ' + response.message);
                    element.innerText =originalValue;
                }
                },
                error: function (error) {
                    // Handle the error if needed
                    console.error(error);
                }
            });
        }
    }
    function CreateNew()
    {
        var formData = {
                    name: document.getElementById('name').value,
                    college: document.getElementById('college').value,
                    location: document.getElementById('location').value,
                    email: document.getElementById('email').value,
                    mobile: document.getElementById('mobile').value,
                    department: document.getElementById('department').value,
                    doj: document.getElementById('doj').value,
                    duration: document.getElementById('duration').value,
                    ejm: $("#ejm").is(":checked") ? 1 : 0,
                    ol: $("#ol").is(":checked") ? 1 : 0,
                    is_employee: $("#is_employee").is(":checked") ? 1 : 0,
                    sod:$("#sod").is(":checked") ? 1 : 0,
                    video: $("#video").is(":checked") ? 1 : 0,
                    review: $("#review").is(":checked") ? 1 : 0,
                    feedback_form: $("#feedback_form").is(":checked") ? 1 : 0,
                    certificate: $("#certificate").is(":checked") ? 1 : 0,
                    recommendation_letter: $("#recommendation_letter").is(":checked") ? 1 : 0,
                    app_letter:$("#app_letter").is(":checked") ? 1 : 0,
                    batch: document.getElementById('batch').value,
                    tpo: document.getElementById('tpo').value,
                    tpo_contact: document.getElementById('tpo_contact').value,
                    tpo_email: document.getElementById('tpo_email').value
                };
// AJAX POST request
            $.ajax({
                type: 'POST',
                url: 'create_doj.php',
                data: formData,
                success: function (response) {
                    // Handle success response here
                    if (response.status === 'success') {
                    alert('Added successfully!');
                    window.location.href = 'DojListing.php';
                    
                } else {
                    alert('Error: ' + response.message);
                }

                    // You can update the UI or perform other actions based on the response
                },
                error: function (error) {
                    // Handle error here
                    console.error(error);
                }
            });
    }
    function CreatEmployee()
    {
        
    }

    </script>
</html>

