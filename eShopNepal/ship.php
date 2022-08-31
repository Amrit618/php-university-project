<?php 
    include 'includes/connect.php';
    session_start();

    $user_id = $_GET['user_id'];
    $status = $_GET['status'];
    $category = $_GET['category'];
    $product_id = $_GET['product_id'];

    if(isset($user_id) && isset($status) && isset($category) && isset($product_id)) {
        mysqli_query($con, "UPDATE orders SET status='$status' WHERE user_id='$user_id' AND category='$category' AND product_id='$product_id'");

        header("Location: view_orders.php");
    }
?>