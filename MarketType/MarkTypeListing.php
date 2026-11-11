<?php
session_start();
// if (!isset($_SESSION["AdminLoginId"])) {
//     header("location: ../AdminLogin.php");
// }
$emp_id = isset($_GET['emp_id']) ? $_GET['emp_id'] : '';
$type = isset($_GET['Type']) ? $_GET['Type'] : null;
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
if ($type == 1) {
    $href = "MarkTypeListing.php?emp_id=$emp_id&Type=2&project_id=$project_id";
    $text = "Submitted";
} else {
    $href = "MarkTypeListing.php?emp_id=$emp_id&Type=1&project_id=$project_id";
    $text = "Saved";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
    <title>Type Wise List</title>
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .table-header {
            background-color: black;
            color: white;
            border: none;
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
        <li>
                <a href="../Dashboard/AdminDashboard.php">
                    <i class='bx bxs-dashboard' style="width: 2px" ;></i>

                    <span class="text">Dashboard</span>
                </a>
            </li>    
            <li>
                <a href="../dash.html">
                    <i class='bx bxs-dashboard' style="width: 2px" ;></i>

                    <span class="text">Blank Form</span>
                </a>
            </li>
            <li class="active">
                <a
                    href="../MarketType/MarkTypeListing.php?emp_id=<?php echo $emp_id; ?>&Type=1&project_id=<?php echo $project_id; ?>">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">
                        Save Form
                    </span>
                </a>
            </li>
            <li>
                <a
                    href="../MarketType/MarkTypeListing.php?emp_id=<?php echo $emp_id; ?>&Type=2&project_id=<?php echo $project_id; ?>">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Submit Form</span>
                </a>
            </li>
            <!--<li>
                <a href="dashEID.html">
                    <i class='bx bxs-group'></i>
                    <span class="text">Invitation Soft Copy</span>
                </a>
            </li>
            <li>-->
            <!--<a href="#">
                        <i class='bx bxs-group'></i>
                        <span class="text">Report Bag</span>
                    </a>
                </li>]
                <li>
                    <a href="#">
                        <i class='bx bxs-group'></i>
                        <span class="text">Transalate</span>
                    </a>-->
            <!--</li>-->
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
            <a href="#" class="nav-link">Search here</a>
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
            <div id="wrapper">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-danger fs-15">Project <?php $project_id =$_GET['project_id'];
                            echo $project_id; ?> Employee
                                <?php echo $emp_id; ?> List</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="employeetable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-header">
                                            <td></td>
                                            <td>Id</td>
                                            <td>Name</td>
                                            <td>Designation</td>
                                            <td>Company</td>
                                            <td>Address</td>
                                            <td>Phone</td>
                                            <td>Email</td>
                                            <td>City</td>
                                            <td>State</td>
                                            <td>Pincode</td>
                                            <td>Date</td>
                                            <td>Visitor</td>
                                            <td>ExhibitorsLR</td>
                                            <td>ExhibitorsA</td>
                                            <td>Image</td>
                                            <td>Feedback</td>
                                            <td>Location</td>
                                            
                                            <?php
                                            if ($type == 1) {
                                                echo '<td>Edit</td>';
                                                echo '<td>Submit</td>';
                                            }
                                            ?>
                                            <?php
                                            if ($type == 2) {
                                                echo '<td>Download</td>';
                                            }
                                            ?>

                                            <!-- <td>Project_Id </td>
                                <td>Type </td> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "table.php"
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="../Template/vendor/jquery/jquery.min.js"></script>
    <script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../Template/js/popper.min.js"></script>
    <script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('[data-toggle="tooltip"]').tooltip();
            var type = <?php echo $type; ?>;
            if (type == 1) {
                console.log("okkkk");
                var dataTable = $('#employeetable').DataTable({
                    "order": [
                        [0, "asc"]
                    ]
                });
            } else {
                var dataTable = $('#employeetable').DataTable({
                    "order": [
                        [0, "asc"]
                    ]
                });
            }

        });

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
                // Send the updated data to your PHP script (update_media.php)
                $.ajax({
                    url: 'update_media.php',
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
                            element.innerText = originalValue;
                        }
                    },
                    error: function (error) {
                        // Handle the error if needed
                        console.error(error);
                    }
                });
            }
        }

        function submitRow(rowid) {
            $.ajax({
                url: 'update_type.php', // Change to the actual PHP file path
                type: 'POST',
                data: {
                    ids: rowid
                }, // Send the extracted IDs as data
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.href = 'MarkTypeListing.php?emp_id=<?php echo $emp_id; ?>&Type=<?php echo $type; ?>&project_id=<?php echo $project_id; ?>';
                    } else {
                        console.error('Error fetching data:', response.message);
                    }
                },
                error: function (error) {
                    console.error('Error updating data:', error);
                }
            });
        }

        function printdata(data) {
            var headers = [];
            headers = getAllKeysFromJSON(data);
            console.log(headers);
            var employeetable = $('#employeetable').DataTable({
                data: data,
                columns: headers.map(function (header) {
                    return {
                        data: header,
                        title: header
                    };
                }),
                columnDefs: [{
                    orderable: true,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'multi',
                },
                order: [
                    [1, 'asc']
                ]
            });
        }

        function getAllKeysFromJSON(jsonData) {
            // Create an array to store all keys
            const allKeys = [];

            // Iterate through the array of objects and collect all keys
            jsonData.forEach(book => {
                Object.keys(book).forEach(key => {
                    if (!allKeys.includes(key)) {
                        allKeys.push(key);
                    }
                });
            });

            return allKeys;
        }
    </script>
</body>

</html>