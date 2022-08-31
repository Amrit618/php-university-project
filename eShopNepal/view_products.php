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
    <title>ADMIN LOGIN | PRODUCTS</title>
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Header of the page -->

    <?php include 'includes/admin_nav.php'; ?>

    <div id="allproducts">

        <?php
            $all_tables = array("COMPUTERS" => "product_comp", "ELECTRONICS" => "product_electronics", "HOME" => "product_home", "MENS PRODUCT" => "product_men", "MOBILES" => "product_mobile", "WOMENS PRODUCT" => "product_women");
            
            foreach($all_tables as $title => $tablename) {

                $result = mysqli_query($con, "SELECT prod_id, prod_name, prod_image, prod_price, prod_quan FROM $tablename ORDER BY prod_id DESC");

                ?>
                    <div class="allproductssection">
                        <div class="header">
                            <?php echo $title; ?>
                        </div>

                        <?php 

                            while($row = mysqli_fetch_assoc($result)) {
                                $prod_id = $row['prod_id'];
                                $prod_image = $row['prod_image'];
                                $prod_name = $row['prod_name'];
                                $prod_price = $row['prod_price'];
                                $prod_quantity = $row['prod_quan'];
                                switch($tablename){
                                    case 'product_comp':
                                        $url = 'add_comp.php';
                                        break;
                                    case 'product_electronics':
                                        $url = 'add_electronics.php';
                                        break;
                                    case 'product_home':
                                        $url = 'add_home.php';
                                        break;
                                    case 'product_men':
                                        $url = 'add_men.php';
                                        break;
                                    case 'product_mobile':
                                        $url = 'add_mobile.php';
                                        break;
                                    default:
                                        $url = 'add_women.php';
                                        break;
                                }
                                
                                ?>
                                    <div class="products">
                                        <div class="products_desc">
                                            <div class="products_image">
                                                <img src="./images/<?php echo $prod_image; ?>">
                                            </div>

                                            <div class="products_desc_text">
                                                <div class="products_name">
                                                    <?php echo $prod_name; ?>
                                                </div>

                                                <div class="products_price">
                                                    <?php echo $prod_price; ?>
                                                </div>

                                                <div class="products_quantity">
                                                    Quantity: <?php echo $prod_quantity; ?>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="products_buttons">
                                            <button onclick="window.location.href='<?php echo $url ?>?product_id=<?php echo $prod_id ?>'">
                                                Edit
                                            </button>

                                            <button onclick="location.href='delete_product.php?table_name=<?php echo $tablename; ?>&prod_id=<?php echo $prod_id; ?>'">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                <?php
                            }

                        ?>
                    </div>
                <?php
            }
        ?>
<!-- 
        <div class="allproductssection">
            <div class="header">
                COMPUTER
            </div>

            <div class="products">
                <div class="products_desc">
                    <div class="products_image">
                        <img src="./images/13t.jpg">
                    </div>

                    <div class="products_desc_text">
                        <div class="products_name">
                            IMac
                        </div>

                        <div class="products_price">
                            Rs. 1000
                        </div>

                        <div class="products_quantity">
                            Quantity: 10
                        </div>
                    </div>  
                </div>

                <div class="products_buttons">
                    <button>
                        Edit
                    </button>

                    <button>
                        Delete
                    </button>
                </div>
            </div>
        </div> -->

    </div>
</body>
</html>