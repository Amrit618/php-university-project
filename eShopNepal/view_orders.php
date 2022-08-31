<?php 
    session_start();

    include 'includes/connect.php';

    if( !isset($_SESSION['adminlogin']) ) {
        header("Location: admin_login.php");
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

    <?php include 'includes/admin_nav.php'; ?>

    <div id="user_orders">
        

        <div id="desc">
            All the orders from the customers are listed below:
        </div>

        <?php 
            $result = mysqli_query($con, "SELECT * FROM orders ORDER BY id DESC");
            $length = mysqli_num_rows($result);

            if($length > 0) {
                ?>
                    <table class="resp_table">
                        <tr>

                            <th>
                                IMAGE
                            </th>

                            <th>
                                PRODUCT NAME
                            </th>

                            <th>
                                QUANTITY
                            </th>

                            <th>
                                USER
                            </th>

                            <th>
                                LOCATION
                            </th>

                            <th>
                                CONTACT No.
                            </th>

                            <th>
                                ACTION
                            </th>
                        </tr>
                            

                        <?php 
                            while($row = mysqli_fetch_assoc($result)) {
                                $product_image = $row['product_image'];
                                $product_id = $row['product_id'];
                                $order_quantity = $row['order_quantity'];
                                $user_id = $row['user_id'];
                                $category = $row['category'];
                                $location = $row['location'];

                                // FETCH THE PRODUCT NAME FROM PRODUCT_ID AND CATEGORY
                                $product_name = mysqli_fetch_row(mysqli_query($con, "SELECT prod_name FROM $category WHERE prod_id='$product_id'"))[0];
                                $user_name_array = mysqli_fetch_row(mysqli_query($con, "SELECT firstname, lastname, phone from register WHERE id='$user_id'"));
                                $user_name = $user_name_array[0] . ' ' . $user_name_array[1];
                                $phone = $user_name_array[2];
                                ?>
                                    <tr>
                                        <td>
                                            <img src ="images/<?php echo $product_image; ?>" style="height: 100px; width: 100px;">
                                        </td>

                                        <td>
                                            <?php echo $product_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $order_quantity; ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $user_name;
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                                echo $location;
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <?php
                                                echo $phone;
                                            ?>
                                        </td>
                                        
                                        <td>

                                            <?php 
                                                $shipped = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM orders WHERE product_id='$product_id' AND category='$category' AND user_id='$user_id'"))['status'];
                                                
                                                if($shipped == "shipping") {
                                                    ?>
                                                        <span style="color: #ff6554;display: block;margin-bottom: 5px;">
                                                            Shipping
                                                        </span>

                                                        <button style="background: #ff6554;" onclick="location.href='ship.php?user_id=<?php echo $user_id; ?>&status=shipped&category=<?php echo $category; ?>&product_id=<?php echo $product_id; ?>'">PAYMENT RECEIVED</button> 
                                                    <?php
                                                } else if($shipped == "notshipped") {
                                                    ?>
                                                        <button onclick="location.href='ship.php?user_id=<?php echo $user_id; ?>&status=shipping&category=<?php echo $category; ?>&product_id=<?php echo $product_id; ?>'">SHIP</button> 
                                                    <?php
                                                } else if($shipped == "shipped") {
                                                    ?>
                                                        <span style="color: #24b56f;display: block; margin-bottom: 5px">Product Shipped</span>

                                                        <span style="background: #24b56f;color: white;border-radius: 4px; padding: 6px;
                                                        margin: 10px;display: block;">Payment Received</span>
                                                    <?php
                                                }
                                            ?>

                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </table>
                <?php
            } else {

                ?>
                    <div>
                        NO DATA
                    </div>
                <?php
            }

        ?>
    </div>
</body>
</html>