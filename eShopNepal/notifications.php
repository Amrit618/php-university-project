<?php include 'includes/connect.php';
session_start();
if( isset($_SESSION['adminlogin']) ) {
	header("Location: admin_login.php");
} 

$username = '';
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];		
    $user_id = $_SESSION['user_id'];												
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>eShopNepal</title>
        <link rel = "stylesheet" href = "css/style.css">

    </head>
    <body>
		<?php include 'includes/header.php'; ?> <!-- Header of the page -->

        <?php include 'includes/navbar.php'; ?> <!-- Navigation bar of the page -->

        <div id = "bodyleft">
            
            <div style="padding: 10px;">

                <div style="padding: 20px; color: #a1a1a1;border-bottom: 1px solid #e1e1e1;">Your Notifications</div>
                <ul id="notificationul">

                <?php 
                    $result = mysqli_query($con, "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC");
                    
                    if(mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)) {
                        $status = $row['status'];
                        $product_id = $row['product_id'];
                        $category = $row['category'];
                        $order_quantity = $row['order_quantity'];

                        $product_name = mysqli_fetch_row(mysqli_query($con, "SELECT prod_name FROM $category WHERE prod_id='$product_id'"))[0];
                        if($status == "shipping") {
                            ?>
                                <li>
                                    - You have ordered <?php echo $order_quantity . ' ' . $product_name; ?> . Your product is being shipped and will be arriving in 2 days. 
                                </li>
                            <?php
                        } else if($status == "shipped") {
                            ?>
                                <li>
                                    - Your order <?php echo $product_name; ?> is shipped and your payment is verified. Thank you for using our service.
                                </li>
                            <?php
                        }
                        
                    }} else {
                        echo "No notifications!";
                    }
                ?>
                </ul>

            </div>

        </div>

        <?php include 'includes/sidenews.php'; ?> <!-- sidenews Of the page -->

        <?php include 'includes/footer.php'; ?> <!-- Footer of the page -->
    </body>



</html>
