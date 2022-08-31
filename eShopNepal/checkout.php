
<?php 
include 'includes/connect.php';
session_start();
$userOrders = $_SESSION['product_name'];

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    for($i=0;$i<sizeof($_SESSION['product_name']);$i++)
    {
        $product_image = $_SESSION['product_image'][$i];
        $product_id = $_SESSION['product_id'][$i];
        $product_quantity= $_SESSION['product_quantity'][$i];
        $category = $_SESSION['category'][$i];
        $location = $_SESSION['location'][$i];
        $sql = "INSERT INTO `orders`(`product_image`, `product_id`, `order_quantity`, `user_id`, `location`, `category`, `status`) VALUES ('$product_image','$product_id','$product_quantity','$user_id','$location','$category', 'notshipped')";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con)); 

        if($result) {
            header("Location: index.php");
        }
    }
} else {
    header("Location: login.php?error_message=Login to checkout!");
}



?>
