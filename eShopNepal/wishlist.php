<?php include 'includes/connect.php'; ?>
<?php
    session_start();

    $prod_id = $_GET['prod_id'];
    $cat_name = $_GET['prod_name'];
    $username = $_SESSION['username'];

    if(isset($prod_id) && isset($cat_name) && isset($username)) {

        $result = mysqli_query($con, "SELECT * FROM wishlist WHERE prod_id='$prod_id' AND cat_name='$cat_name' AND username='$username'");
        
        if(mysqli_num_rows($result) == 0) {
            mysqli_query($con, "INSERT INTO wishlist VALUES (NULL, '$prod_id', '$cat_name', '$username')")
            or die("CANNOT INSERT");

            header("Location: view_wishlist.php");
        } else {
            echo 'Already in wishlist';
        }
    } else {
        header("Location: login.php?error_message=Login to add in Wishlist");
    }
?>