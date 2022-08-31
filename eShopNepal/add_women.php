<?php
	session_start();
	
	include 'includes/connect.php';
	$prod_no="";
    $prod_name="";
    $prod_price="";
    $prod_quan="";
	$prod_keyword="";
	$id;
	if(isset($_GET['product_id'])){
		$id = $_GET['product_id'];
		
		$getData = mysqli_query($con,"select * from product_women where prod_id ='$id'");
		if(mysqli_num_rows($getData) >= 1){
			$row = mysqli_fetch_array($getData,MYSQLI_ASSOC);
				$prod_no=$row['prod_no'];
                $prod_name=$row['prod_name'];
                $prod_price=$row['prod_price'];
                $prod_quan=$row['prod_quan'];
                $prod_keyword=$row['keyword'];
			

			
		}

	}
	$msg = "";
	$submit = @$_POST['submit'];
	
	if($submit == "Submit"){
		$id=null;
		if(isset($_GET['product_id'])){
			$id = $_GET['product_id'];
		}
		if(empty($_POST['txtProdNo']))
			$msg = "Product No is empty!";
		else{
			if($id)
			{
				
				$prod_no=$_POST['txtProdNo'];
					$prod_name=$_POST['txtProdName'];
					$prod_price=$_POST['txtProdPrice'];
					$prod_quan=$_POST['txtProdQuan'];
					$prod_keyword=$_POST['txtProdKeyword'];
					$image = file_get_contents ($_FILES['txtProdImage']['tmp_name']);
					$image_name = $_FILES['txtProdImage']['name'];
	
					$target = "images/".basename($_FILES['txtProdImage']['name']);
	
					if(move_uploaded_file($_FILES['txtProdImage']['tmp_name'], $target)) {
						$sql = "UPDATE `product_women` SET `prod_no`='$prod_no', `prod_name`='$prod_name',`prod_image`='$image_name', `prod_price`='$prod_price', `prod_quan`='$prod_quan', `date_added`=now(), `keyword`='$prod_keyword',`category`='product_women'  WHERE `prod_id`='$id'";
						
						mysqli_query($con, $sql) or die(mysqli_error($con));
					} else {
						die("ERROR!");
					}
				
			}
			else{
				$sqlSelExistNO= mysqli_query($con,"select * from product_women where prod_id = '$_POST[txtProdNo]'");
				if(mysqli_num_rows($sqlSelExistNO) >= 1)
					$msg = "Product ID is already in use!";
				else{
					$prod_no=$_POST['txtProdNo'];
					$prod_name=$_POST['txtProdName'];
					$prod_price=$_POST['txtProdPrice'];
					$prod_quan=$_POST['txtProdQuan'];
					$prod_keyword=$_POST['txtProdKeyword'];
					$image = file_get_contents ($_FILES['txtProdImage']['tmp_name']);
					$image_name = $_FILES['txtProdImage']['name'];
					
					$target = "images/".basename($_FILES['txtProdImage']['name']);
	
					if(move_uploaded_file($_FILES['txtProdImage']['tmp_name'], $target)) {
	
						$sql = "INSERT INTO `product_women`(`prod_id`, `prod_no`, `prod_name`,`prod_image`, `prod_price`, `prod_quan`, `date_added`, `keyword`,`category`) VALUES (NULL,'$prod_no','$prod_name','$image_name','$prod_price','$prod_quan',now(),'$prod_keyword','product_women')";
						
						mysqli_query($con, $sql) or die(mysqli_error($con));
						
					} else {
						die("ERROR!");
					}
					
				   
				}
			}
		
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
			<h2>WOMENS PRODUCT INFORMATION<span style="color: #a11; font-size: 13px; margin-left: 50px;"><?php echo $msg; ?><span></h2>
			
                <div id = "form">
				<form id="addnew_product_form" method="post" action="" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Product No:</td>
					<td><input  class = "input_form" type="text" name="txtProdNo" value="<?php echo $prod_no ?>"></td>
				</tr>
				<tr>
					<td>Product Name:</td>
					<td><input  class = "input_form"  type="text" name="txtProdName" value="<?php echo $prod_name ?>"/></td>
				</tr>
                <tr>
					<td>Product Image:</td>
					<td><input  class = "input_form"  type="file" name="txtProdImage" /></td>
				</tr>
              

				<tr>
					<td>Product Price:</td>
					<td><input  class = "input_form"  type="text" name="txtProdPrice" value="<?php echo $prod_price ?>" /></td>
				</tr>
				<tr>
					<td>Product Quantity:</td>
					<td><input  class = "input_form" type="text" name="txtProdQuan" value="<?php echo $prod_quan ?>"/></td>
				</tr>
                <tr>
					<td>Product Keyword:</td>
					<td><input  class = "input_form"  type="text" name="txtProdKeyword" value="<?php echo $prod_keyword ?>"/></td>
				</tr>
			</table>
			<input id="sub_btn" type="submit" name="submit" value="Submit">
			</form>
                </div>
		</div><!-- end of content -->
		
	</div><!-- end of con -->
	
</div>
</body>
</html>