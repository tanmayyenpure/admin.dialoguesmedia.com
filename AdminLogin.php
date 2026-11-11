<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- <link rel="stylesheet" href="./css/login.css"> -->
  <title>Admin Login</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap');

body {
  background: #f6f2f2;
  font-family: raleway;
  color: white;
  margin: 0;
}

.popup .content {
  position: absolute;
  top: 10%;
  left: 35%;
  /* transform: translate(-50%, -150%) scale(0); */

  width: 300px;
  height: 450px;
  z-index: 2;
  text-align: center;
  padding: 20px;
  border-radius: 20px;
  background: #8e0c0c;
  z-index: 1;
}

.popup .close-btn {
  position: absolute;
  right: 20px;
  top: 20px;
  width: 30px;
  height: 30px;
  color: #8e0c0c;
  font-size: 30px;
  border-radius: 50%;
  padding: 2px 5px 7px 5px;
  /* background: #f4eeee; */
}

.popup.active .content {
  transition: all 300ms ease-in-out;
  transform: translate(-50%, -50%) scale(1);
}

h1 {
  text-align: center;
  font-size: 32px;
  font-weight: 600;
  padding-top: 20px;
  padding-bottom: 10px;
}

a {
  font-weight: 600;
  color: white;
}

.input-field .validate {
  padding: 20px;
  font-size: 16px;
  border-radius: 10px;
  border: none;
  margin-bottom: 15px;
  color: #010707;
  background: #faf8f8;
  outline: none;
}

.first-button {
  color: rgb(244, 239, 239);
  font-size: 18px;
  font-weight: 500;
  padding: 10px 20px;
  border-radius: 6px;
  border: none;
  position: absolute;
  top: 10%;
  left: 90%;
  transform: translate(-50%, -50%);
  background: #8e0c0c;
  border: 2px solid black;
  transition: box-shadow .35s ease !important;
  outline: none;
}

.second-button {
  color: rgb(5, 5, 5);
  font-size: 18px;
  font-weight: 500;
  margin-top: 20px;
  padding: 20px 30px;
  border-radius: 40px;
  border: none;
  background: #f9f5f5;
  transition: box-shadow .35s ease !important;
  outline: none;
}

.second-button:active {
  background: linear-gradient(145deg, #222222, #292929);
  box-shadow: 5px 5px 10px #262626, -5px -5px 10px #262626;
  border: none;
  outline: none;
}

p {
  color: #bfc0c0;
  padding: 20px;
}


@media (max-width: 768px) {
  body {
    min-height: 100vh;
    min-height: 100svh;
    display: grid;
    place-items: center;
    padding: 20px 16px;
  }

  h1 {
    font-size: 24px;
  }

  .popup .content {
    box-sizing: border-box;
    position: relative;
    inset: auto;
    transform: none;
    margin: 0;
    width: min(100%, 380px);
    height: auto;
    padding: 28px 22px;
  }


  .input-field .validate {
    box-sizing: border-box;
    font-size: 14px;
    padding: 12px;
    margin-top: 10px;
    width: 100%;
  }

  .second-button {
    width: 100%;
    margin-top: 12px;
  }

  .popup form > p {
    margin: 8px 0 0;
    padding: 12px 0 0;
  }

  .first-button {
    font-size: 14px;
    padding: 8px 12px;
    top: 10px;
    left: auto;
    right: 10px;
    transform: none;
  }
}

</style>

<body>
<div class="popup" id="popup-1">
    <div class="content">
        <div class="close-btn"></div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <h1>Admin Login</h1>
            <div class="input-field">
                <input placeholder="User ID" class="validate" name="adminName" required>
            </div>
            <div class="input-field">
                <input placeholder="Password" type="password" class="validate" name="adminPassword" required>
            </div>

            <button class="second-button" type="submit" name="login">Login</button>

            <p><a href="/signup.html">Forgot-Password</a></p>
        </form>
    </div>
</div>

<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Function to sanitize input
function input_filter($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// ✅ Default Admin Credentials
$defaultUsername = "admin";
$defaultPassword = "12345";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $adminName = input_filter($_POST['adminName']);
    $adminPass = input_filter($_POST['adminPassword']);

    $loginSuccess = false;
    $uid = "";
    $username = "";

    // ✅ Check Default Admin Credentials First
    if ($adminName === $defaultUsername && $adminPass === $defaultPassword) {
        $loginSuccess = true;
        $uid = "0";  // Assign a default UID for admin
        $username = "Default Admin";

        // ✅ Store in session (No insertion in `user_login`)
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_uid'] = $uid;

        // ✅ Directly Redirect to Admin Dashboard
        header("Location: Dashboard/AdminDashboard.php");
        exit();

    } else {
        // ✅ Check Database Admin Credentials
        require_once 'formconnection.php';
        $query = "SELECT uid, username FROM users 
                  WHERE username = ? 
                  AND password = ? 
                  AND role = 'Master Admin'";

        if ($stmt = mysqli_prepare($conn, $query)) {

            mysqli_stmt_bind_param($stmt, "ss", $adminName, $adminPass);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $uid = $row['uid'];
                $username = $row['username'];
                $loginSuccess = true;
            }
            mysqli_stmt_close($stmt);
        }
    }

    if ($loginSuccess) {
        // ✅ Store in session
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_uid'] = $uid;

        // ✅ Insert into `user_login` table only for DB users
        if ($username !== "Default Admin") {
            $insertQuery = "INSERT INTO user_login (uid, emp_id) VALUES (?, ?)";

            if ($insertStmt = mysqli_prepare($conn, $insertQuery)) {
                mysqli_stmt_bind_param($insertStmt, "is", $uid, $username);

                if (mysqli_stmt_execute($insertStmt)) {
                    echo "<script>console.log('Login record inserted successfully');</script>";
                } else {
                    echo "<script>alert('Failed to insert login record');</script>";
                }
                mysqli_stmt_close($insertStmt);
            }
        }

        // ✅ Redirect to Admin Dashboard
        header("Location: Dashboard/AdminDashboard.php");
        exit();

    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}

if (isset($conn) && $conn instanceof mysqli) {
    mysqli_close($conn);
}
?>

</body>
</html>
