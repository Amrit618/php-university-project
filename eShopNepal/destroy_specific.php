<?php
  session_start();

  $specific_id = $_GET['specific_id'];

  // DELETING THE SPECIFIC PRODUCT FROM CART
  array_splice($_SESSION['product_name'], $specific_id, 1);
  array_splice($_SESSION['product_image'], $specific_id, 1);
  array_splice($_SESSION['product_quantity'], $specific_id, 1);
  array_splice($_SESSION['product_id'], $specific_id, 1);
  array_splice($_SESSION['date_added'], $specific_id, 1);
  array_splice($_SESSION['product_price'], $specific_id, 1);
  array_splice($_SESSION['location'], $specific_id, 1);

  header('Location: customercart.php');
?>
