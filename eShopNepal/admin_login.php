<?php 
    session_start();

    if( isset($_SESSION['adminlogin']) ) {
        header("Location: admin.php");
    } 

    include 'includes/connect.php';

    $msg = '';

    if(isset($_POST['login'])) {
        $username = $_POST['admin_username'];
        $password = $_POST['admin_password'];

        if($username && $password) {
            // CHECK IN DATABASE
            $result = mysqli_query($con, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
            $length = mysqli_num_rows($result);
            if($length > 0) {
                // SET THE SESSION FOR THE ADMIN
                $_SESSION['adminlogin'] = $username;

                header("Location: admin.php");
            } else {
                // DISPLAY CANNOT LOGIN
                $msg = "ENTER VALID DETAILS!";
            }
        } else {
            echo "<script>alert('Emty Details');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN LOGIN</title>
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Header of the page -->

    <div id = "navbar">
        <ul>
            <li><a href = "admin_login.php">Admin Login</a></li>
        </ul>
    </div>

    <div id="adminlogin_content">
        <form action="admin_login.php" method="POST">
            Username: <input class="text_box" type="text" name="admin_username" placeholder="admin username">
            <br>
            Password: &nbsp;<input class="text_box" type="password" name="admin_password" placeholder="admin password">
            <br>
            <input class="submit_button" type="submit" value="Login" name="login">
        </form>

        <div id="result">
            <?php 
                echo $msg;
            ?>
        </div>
    </div>
</body>
</html>