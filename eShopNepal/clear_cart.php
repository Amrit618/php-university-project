<?php 
    session_start();

    unset($_SESSION['product_name']);
    unset($_SESSION['product_image']);
    unset($_SESSION['product_quantity']);
    unset($_SESSION['product_id']);
    unset($_SESSION['date_added']);
    unset($_SESSION['product_price']);
    unset($_SESSION['location']);
    unset($_SESSION['category']);

    header("Location: customercart.php");
?>