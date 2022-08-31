<?php
  session_start();

  include 'includes/connect.php';
  
  if( !isset($_SESSION['adminlogin']) ) {
    header("Location: admin_login.php");
  }
	
	$msg = "";
	$submit = @$_POST['submit'];
	
	if($submit == "Submit"){
	   if($_POST['selProdCat'] =="Mobiles & Tablets"){
           header("location:add_mobile.php");  
       }
         if($_POST['selProdCat'] =="Electronics"){
           header("location:add_electronics.php");  
       }
         if($_POST['selProdCat'] =="Computer & Gaming"){
           header("location:add_comp.php");  
       }
         if($_POST['selProdCat'] =="Men's Fashion"){
           header("location:add_men.php");  
       }
         if($_POST['selProdCat'] =="Women's Fashion"){
           header("location:add_women.php");  
       }
         if($_POST['selProdCat'] =="Home & Kitchen"){
           header("location:add_home.php");  
       }
		
		
	}
?>
<html>
    <head>
        <title>eShopNepal</title>
        <link rel = "stylesheet" href = "css/style.css">
              
    </head>
    <body>
        <?php include 'includes/header.php'; ?> <!-- Header of the page -->
        
        <?php include 'includes/admin_nav.php'; ?>
		
		<div id="admin_content">
			<h2>Product Information</h2>
			<div id = "form">
			<form id="addnew_product_form" method="post" action="admin.php" enctype="multipart/form-data">
			<table>
				
				<tr>
					<td>Product Category:</td>
					<td  colspan="3" ><select class = "input_form" name="selProdCat"><option class= "opt"></option><option class= "opt">Mobiles & Tablets</option><option class= "opt">Electronics</option><option class= "opt">Computer & Gaming</option><option class= "opt">Men's Fashion</option><option class= "opt">Women's Fashion</option><option class= "opt">Home & Kitchen</option></select></td>
				</tr>
				
			</table>
			
      <div style="height: 20px;"></div>
			
				<input id="sub_btn" type="submit" name="submit" value="Submit">
				
			</form>
                </div>
		</div><!-- end of content -->

	
</div>
</body>
</html>