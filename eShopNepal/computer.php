<?php include 'includes/connect.php';
session_start();
if( isset($_SESSION['adminlogin']) ) {
	header("Location: admin_login.php");
} 

$username = '';
if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];														
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
        <div class = "cat_disp">
                  <h3>Computer &amp; Gaming</h3>
                   <ul>
                      <?php
  						$sql = "SELECT * FROM product_comp ORDER BY prod_id ASC LIMIT 3";
  						$query = mysqli_query($con,$sql) or die('Error Fetching Data!');

  						if(mysqli_num_rows($query) > 0) {

  							while($row = mysqli_fetch_assoc($query)) {

  								$prod_id = $row['prod_id'];
  								$prod_no = $row['prod_no'];
  								$prod_name = $row['prod_name'];
  								$prod_image = $row['prod_image'];
  								$prod_price = $row['prod_price'];
  								$prod_quan = $row['prod_quan'];
  								$date_added = $row['date_added'];
  								$keyword = $row['keyword'];

  								?>

  									<li onclick="location.href='cart.php?prod_id=<?php echo $prod_id; ?>&amp;prod_name=product_comp'">
  										<div class = "pro_img">
  											<img src = "images/<?php echo $prod_image; ?>">
  										</div>

  										<div class="slide_section">
  											<div class = "pro_head">
  												<?php echo $prod_name; ?>
  											</div>

  											<div class="pro_price">
  												Rs. <?php echo $prod_price; ?>
  											</div>

  											<div class="pro_rating">
  												&#9733;&#9733;&#9733;&#9733;&#9734; <span style="font-size: 14px;color: #333;">4.0 (From Reviews)</span>
  											</div>

  											<div class="pro_wishlist">
											  	<?php 
													if(isset($_SESSION['username'])) {
														$result = mysqli_query($con, "SELECT * FROM wishlist WHERE prod_id='$prod_id' AND cat_name='product_comp' AND username='$username'");
														if(mysqli_num_rows($result) == 0) {
															?>
																<a href="wishlist.php?prod_id=<?php echo $prod_id; ?>&amp;prod_name=product_comp">&#9825; <span style="font-size: 14px;">Add to Wishlist</span></a>
															<?php
														} else {
															?>
																<a style="color: #ff6554;">&hearts; <span style="font-size: 14px;">In your wishlist</span></a>
															<?php
														}
													} else {
														?>
															<a href="wishlist.php?prod_id=<?php echo $prod_id; ?>&amp;prod_name=product_comp">&#9825; <span style="font-size: 14px;">Add to Wishlist</span></a>
														<?php
													}
												?>  
											</div>
  										</div>
  									</li>

  								<?php

  							}

  						} else {
  							echo 'Products not available!';
  						}
  					?>

  					<div style="clear: both;"></div>
                  </ul>
              </div><br clear = "all"/>
      </div>

      <?php include 'includes/sidenews.php'; ?> <!-- sidenews Of the page -->

      <?php include 'includes/footer.php'; ?> <!-- Footer of the page -->
</body>



</html>
