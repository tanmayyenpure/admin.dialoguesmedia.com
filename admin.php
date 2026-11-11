<?php
session_start();
if (!isset($_SESSION["AdminLoginId"])) {
    header("location: AdminLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="./css/style1.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img class="dia" height="80px" src="./assets/imgs/logo3.jpg" alt="">
                        </span>
                        <!-- <span class="title">Brand Name</span> -->
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                   
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <button type="submit" class="logoutb">LogOut</button>
                    </form>


                    <!-- <button onclick="togglePopup()" class="first-button">LogIn</button> -->
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">

                            <?php
                            include "formconnection.php";
                            $sql = mysqli_query($conn, "SELECT * FROM `media`");
                            if ($row = mysqli_num_rows($sql)) {
                                echo "
                                          <tr>
                                             <td>$row</td>
                                          </tr>
                                        ";
                            }
                            ?>
                        </div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Sales</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">People</div>
                        <div class="cardName">300</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td scope="col">S.no</td>
                                <td scope="col">Name</td>
                                <td scope="col">Designation</td>
                                <td scope="col">Company</td>
                                <td scope="col">Address</td>
                                <td scope="col">Phone</td>
                                <td scope="col">Email</td>
                                <td scope="col">City</td>
                                <td scope="col">State</td>
                                <td scope="col">Pincode</td>
                                <td scope="col">Date</td>
                                <td scope="col">Visitor</td>
                                <td scope="col">ExhibitorsLR</td>
                                <td scope="col">ExhibitorsA</td>
                                <td scope="col">Image</td>
                                <td scope="col">Feedback</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include "formconnection.php";
                            $sql = mysqli_query($conn, "SELECT * FROM `media`");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo "
                                          <tr>
                                             <td>$row[id]</td>
                                             <td>$row[name]</td>
                                             <td>$row[designation]</td>
                                             <td>$row[company]</td>
                                             <td>$row[address]</td>
                                             <td>$row[mobile]</td>
                                             <td>$row[email]</td>
                                             <td>$row[city]</td>
                                             <td>$row[state]</td>
                                             <td>$row[pincode]</td>
                                             <td>$row[date]</td>
                                             <td>$row[visitor]</td>
                                             <td>$row[language]</td>
                                             <td>$row[languages]</td>
                                             <td>$row[image]</td>
                                             <td>$row[feedback]</td>
                                          </tr>
                                        ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== popupe form ============ -->
    <div class="popup" id="popup-1">
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">×</div>
            <h1>Admin Sign in</h1>
            <i></i>
            <div class="input-field"><input placeholder="User'Id" class="validate"></div>
            <div class="input-field"><input placeholder="Password" class="validate"></div>
            <button class="second-button">Edit Form</button>
            <p>Don't have an account? <a href="/signup.html">Sign Up</a></p>
        </div>
    </div>


    <!-- ==========Logut Out ===== -->
    <?php
    if (isset($_POST['logoutb'])) {
        session_destroy();
        header("location: form.php");
    }
    ?>
    <!-- ==================== popupe form ============ -->

    <script>
        function togglePopup() {
            document.getElementById("popup-1")
                .classList.toggle("active");
        }
    </script>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>


<!-- <td><a href="#" class="edit">Edit</a> <a href="#" class="edit">Delete</a></td> -->