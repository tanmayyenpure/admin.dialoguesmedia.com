<?php
ob_start();
require("formconnection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <title>HR Admin</title>
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
  h1 {
    font-size: 24px;
  }

  .popup .content {
  position: absolute;
  top: auto%;
  left: 0;
  margin-left: 35px;
  width: 70%;
  height:auto;
}


  .input-field .validate {
    font-size: 14px;
    padding: 12px;
    margin-top:10px;
    width:80%;
  }

  .second-button {
    font-size: 14px;
    padding: 12px;
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

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h1>HR Admin</h1>
                <div class="input-field">
                    <input type="text" placeholder="Username" class="validate" name="username" required> 
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Password" class="validate" name="hrPassword" required>
                </div>

                <button class="second-button" type="submit" name="login">Login</button>

                <p><a href="/hr_forgot_password.html">Forgot-Password</a></p>
            </form>
        </div>
    </div>

    <?php
    function input_filter($data) {
        return htmlspecialchars(trim($data));
    }

    if (isset($_POST['login'])) {
        $username = input_filter($_POST['username']);
        $password = input_filter($_POST['hrPassword']);

        $query = "SELECT uid, username, view_access, edit_access, delete_access FROM users WHERE username = ? AND password = ? AND role = 'HR'";
        
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['hr_username'] = $row['username'];
                $_SESSION['hr_uid'] = $row['uid'];
                $_SESSION['view_access'] = explode(',', $row['view_access'] ?? '');
                $_SESSION['edit_access'] = explode(',', $row['edit_access'] ?? '');
                $_SESSION['delete_access'] = explode(',', $row['delete_access'] ?? '');

                $insertQuery = "INSERT INTO user_login (uid, emp_id) VALUES (?, ?)";
                if ($insertStmt = mysqli_prepare($conn, $insertQuery)) {
                    mysqli_stmt_bind_param($insertStmt, "is", $row['uid'], $row['username']);
                    mysqli_stmt_execute($insertStmt);
                    mysqli_stmt_close($insertStmt);
                }

                header("Location: HrmsDashboard.php");
                exit();
            } else {
                echo "<script>alert('Invalid Username or Password');</script>";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
    ?>
</body>
</html>
