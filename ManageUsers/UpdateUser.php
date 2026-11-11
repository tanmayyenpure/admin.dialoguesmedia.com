<?php
include '../formconnection.php';

// Get uid from URL
$uid = isset($_GET['uid']) ? $_GET['uid'] : '';

if (!$uid) {
    echo "<script>alert('User ID is missing.'); window.location.href = 'user_list.php';</script>";
    exit;
}

// Fetch user data including access details
$query = "SELECT * FROM users WHERE uid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Extracting access data
    $access = explode(',', $user['access']);
    $view_access = $user['view_access'] ? explode(',', $user['view_access']) : [];
    $edit_access = $user['edit_access'] ? explode(',', $user['edit_access']) : [];
    $delete_access = $user['delete_access'] ? explode(',', $user['delete_access']) : [];

} else {
    echo "<script>alert('User not found.'); window.location.href = 'user_list.php';</script>";
    exit;
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=0.1, user-scalable=yes">
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #sidebar {
            background-color: #8e0c0c !important;
        }

        #sidebar .side-menu li a {
            color: #fff !important;
            background-color: transparent !important;
            border: none !important;
        }

        #sidebar .side-menu li.active a,
        #sidebar .side-menu li a:hover {
            background-color: #fff !important;
            color: #8e0c0c !important;
        }

        #sidebar .brand {
            color: #fff !important;
            background-color: #8e0c0c !important;
            padding: 10px;
        }

        #sidebar .brand img {
            width: 40px;
            height: auto;
        }

        .employetask {
            display: flex;
        }

        .employetask label {
            margin-left: 5px;
        }

        .access-data {
            margin-left: 50px;
        }
    </style>
    <title>Update User</title>
</head>

<body>

<section id="sidebar">
    <a href="#" class="brand">
        <img src="../img/apple.png" alt="">
        <span class="text">Dialoguesmedia</span>
    </a>
    <ul class="side-menu top">
        <li>
            <a href="../Dashboard/AdminDashboard.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
    </ul>
</section>

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
    </nav>

    <main>
        <div class="container mt-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-center align-items-center">
                    <h6 class="m-0 font-weight-bold fs-30" style="color: #b42222;">Update User</h6>
                </div>
                <div class="card-body">
                    <form id="UpdateForm" method="POST">

                    <input type="hidden" name="uid" value="<?= $uid ?>">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" placeholder="Name" id="name" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" placeholder="Employee ID, EX:DM001" id="username" class="form-control"
                                   name="username" value="<?= $user['username'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="text" placeholder="Leave blank to keep existing" id="password"
                                   class="form-control" name="password" value="<?= $user['password'] ?>" >
                        </div>

                        

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role" required>
                                <option value="Master Admin" <?= $user['role'] == 'Master Admin' ? 'selected' : '' ?>>Master Admin</option>
                                <option value="User Admin" <?= $user['role'] == 'User Admin' ? 'selected' : '' ?>>User Admin</option>
                                <option value="HR" <?= $user['role'] == 'HR' ? 'selected' : '' ?>>HR</option>
                                <option value="Manager" <?= $user['role'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                                <option value="Developer" <?= $user['role'] == 'Developer' ? 'selected' : '' ?>>Developer</option>
                                <option value="Designer" <?= $user['role'] == 'Designer' ? 'selected' : '' ?>>Designer</option>
                                <option value="Tester" <?= $user['role'] == 'Tester' ? 'selected' : '' ?>>Tester</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <label>Access:</label>
    <div style="display: flex; gap: 100px;">

        <!-- View Access -->
        <div class="access-data">
            <div>
                <input type="checkbox" id="view" name="access[]" value="view"  <?= in_array('view', $access) ? 'checked' : '' ?>  required>
                <label for="view">View</label>
            </div>
            <div style="margin-left: 20px;">
                <label>Page Access:</label>
                <div class="employetask">
                    <input type="checkbox" id="view_full_access" name="view_access[]" value="Employee Task" <?= in_array('Employee Task', $view_access) ? 'checked' : '' ?>>
                    <label for="view_full_access">Employee Task</label>
                </div>
                <div>
                    <input type="checkbox" id="view_partial_access" name="view_access[]" value="Roaster" <?= in_array('Roaster', $view_access) ? 'checked' : '' ?>>
                    <label for="view_partial_access">Roaster</label>
                </div>
                <div>
                    <input type="checkbox" id="view_restricted_access" name="view_access[]" value="DOJ" <?= in_array('DOJ', $view_access) ? 'checked' : '' ?>>
                    <label for="view_restricted_access">DOJ</label>
                </div>
            </div>
        </div>

        <!-- Edit Access -->
        <div class="access-data">
            <div>
                <input type="checkbox" id="edit" name="access[]" value="edit"  <?= in_array('edit', $access) ? 'checked' : '' ?>  required>
                <label for="edit">Edit</label>
            </div>
            <div style="margin-left: 20px;">
                <label>Page Access:</label>
                <div class="employetask">
                    <input type="checkbox" id="edit_full_access" name="edit_access[]" value="Employee Task" <?= in_array('Employee Task', $edit_access) ? 'checked' : '' ?>>
                    <label for="edit_full_access">Employee Task</label>
                </div>
                <div>
                    <input type="checkbox" id="edit_partial_access" name="edit_access[]" value="Roaster" <?= in_array('Roaster', $edit_access) ? 'checked' : '' ?>>
                    <label for="edit_partial_access">Roaster</label>
                </div>
                <div>
                    <input type="checkbox" id="edit_restricted_access" name="edit_access[]" value="DOJ" <?= in_array('DOJ', $edit_access) ? 'checked' : '' ?>>
                    <label for="edit_restricted_access">DOJ</label>
                </div>
            </div>
        </div>

        <!-- Delete Access -->
        <div class="access-data">
            <div>
                <input type="checkbox" id="delete" name="access[]" value="delete"  <?= in_array('delete', $access) ? 'checked' : '' ?> required>
                <label for="delete">Delete</label>
            </div>
            <div style="margin-left: 20px;">
                <label>Page Access:</label>
                <div class="employetask">
                    <input type="checkbox" id="delete_full_access" name="delete_access[]" value="Employee Task" <?= in_array('Employee Task', $delete_access) ? 'checked' : '' ?>>
                    <label for="delete_full_access">Employee Task</label>
                </div>
                <div>
                    <input type="checkbox" id="delete_partial_access" name="delete_access[]" value="Roaster" <?= in_array('Roaster', $delete_access) ? 'checked' : '' ?>>
                    <label for="delete_partial_access">Roaster</label>
                </div>
                <div>
                    <input type="checkbox" id="delete_restricted_access" name="delete_access[]" value="DOJ"  <?= in_array('DOJ', $delete_access) ? 'checked' : '' ?>>
                    <label for="delete_restricted_access">DOJ</label>
                </div>
            </div>
        </div>

                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="resultMessage"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
    $('#UpdateForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'process_update_user.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#resultMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                    $('#resultModal').modal('show');

                    // Reload the page after 2 seconds
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('#resultMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    $('#resultModal').modal('show');
                }
            },
            error: function () {
                $('#resultMessage').html('<div class="alert alert-danger">Failed to update user.</div>');
                $('#resultModal').modal('show');
            }
        });
    });
});

    </script>

</body>
</html>
