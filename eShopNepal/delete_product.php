<?php 
    include 'includes/connect.php';

    if(isset($_GET['table_name']) && isset($_GET['prod_id'])) {
        
        $table_name = $_GET['table_name'];
        $prod_id = $_GET['prod_id'];

        $result = mysqli_query($con, "DELETE FROM $table_name WHERE prod_id='$prod_id'");

        if($result) {
            header("Location: view_products.php");
        } else {
            die("ERROR DELTING!");
        }

    } else {
        die("ERROR!");
    }
?>