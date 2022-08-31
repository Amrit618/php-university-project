<?php include 'includes/connect.php'; ?>
<?php
    session_start();

    $username = '';
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];														
    }
    
    $msg = '';

    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
	if( isset($_GET['prod_id']) && isset($_GET['prod_name']) ) {
		$product_id = $_GET['prod_id'];
		$table_name = $_GET['prod_name']; // table name

		if($product_id >= 1) {
			// Extracting the value of from the tables
			$sql = "SELECT * FROM $table_name WHERE prod_id='$product_id'";
			$result = mysqli_query($con, $sql) or die('Error, Loading table!');

			if(mysqli_num_rows($result) > 0) {
				$row =  mysqli_fetch_assoc($result);

				$prod_no = $row['prod_no'];
				$prod_name = $row['prod_name'];
				$prod_image = $row['prod_image'];
				$prod_price = $row['prod_price'];
				$prod_quan = $row['prod_quan'];
                $date_added = $row['date_added'];
                $prod_category=$row['category'];
			}

		} else {
			die('Sorry, Not available!');
		}
	} 

	if( isset($_POST['add_to_cart']) ) {
		$product_quantity = $_POST['product_quantity'];
		$location = $_POST['location'];

		if( $location && $product_quantity ) {

			$product_name = $prod_name;
			$date_added = date('y-m-d');
			$product_price = $prod_price;

			//adding these to the sessions
			if(empty($_SESSION['product_name'])) {
				$_SESSION['product_name'] = array();
				$_SESSION['product_image'] = array();
				$_SESSION['product_quantity'] = array();
				$_SESSION['product_id'] = array();
				$_SESSION['date_added'] = array();
				$_SESSION['product_price'] = array();
                $_SESSION['location'] = array();
                $_SESSION['category'] = array();
                
			}

			array_push($_SESSION['product_name'],$product_name);
			array_push($_SESSION['product_image'],$prod_image);
			array_push($_SESSION['product_quantity'],$product_quantity);
			array_push($_SESSION['product_id'],$product_id);
			array_push($_SESSION['date_added'],$date_added);
			array_push($_SESSION['product_price'],$product_price);
            array_push($_SESSION['location'],$location);
            array_push($_SESSION['category'],$prod_category);
            


			header('Location: customercart.php');
		} else {
			$msg = '*Empty Field!';
		}
	}

    if (isset($_POST['submit_comment'])){
    if ($_SESSION['username']){
    $comment = test_input($_POST['comment']);
    $username = $_SESSION['username'];    
     $product_id = $_GET['prod_id'];  
        $table_name = $_GET['prod_name'];
    $sql = "INSERT INTO comment (prod_id,cat_name,username,comment) values('$product_id','$table_name','$username','$comment')";
    $result = mysqli_query($con,$sql);
        if (!$result){
            echo '<script>alert("Error In Comment") </script>';
        }
        
    }else{
        echo '
        <script>
        alert("User Not logged In!  Login To continue");
        </script>
        
        ';
        $_SESSION['comment'] = test_input($_POST['comment']);
        header('refresh:0,url=login.php');
    }
}

if (isset($_POST['reply'])){
    if (isset($_SESSION['username'])){
    $cmnt_id = $_POST['cmnt_id'];
    $reply_text = test_input($_POST['reply_text']);
    $username = $_SESSION['username'];
    $sql = "INSERT INTO reply (cmnt_id,username,reply_text) VALUES ('$cmnt_id','$username','$reply_text')";
    $result = mysqli_query($con,$sql);
    
    if(!$result){
        echo "Error CHECK:".mysqli_error($con);
    }
}else{
       echo '
        <script>
        alert("User Not logged In!  Login To continue");
        </script>
        
        ';
        $_SESSION['comment'] = test_input($_POST['comment']);
        header('refresh:0,url=login.php');  
    }
}


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
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

			<div id="bodyleft_left_section">
				<img src="images/<?php echo $prod_image; ?>">
			</div>

			<div id="bodyleft_right_section">
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?prod_id=<?php echo $product_id; ?>&amp;prod_name=<?php echo $table_name; ?>" method="post">

				<div id="product_name">
					<!-- right part title of the product -->

					<?php
						echo $prod_name;
					?>
				</div>


				<div id="product_price">
					<!-- right part price of the product -->

					Price: (all tax inc.)
					<?php
						echo "<div style='color: red;font-size: 18px;font-weight:bold;'> Rs. " . $prod_price . "</div>";
					?>
				</div>

				<div id="product_quantity">
					<!-- Selecting the quantity of the product -->

						<span style="color: javascript:void(0)222;">Quantity:</span>
						<select name="product_quantity">

							<?php
								for($i=1;$i<=$prod_quan;$i++) {
									?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php
								}
							?>
						</select>

						<?php echo " of ". $prod_quan ." items" ?>
				</div>

				<div id="location">
					<!-- location of the customer -->

					Location:
						<input type="text" name="location" placeholder="Location..."> 

                        <span style="color: #ff6161;">
                            <?php echo $msg; ?>
                        </span>

				</div>

				<!-- Finally the Add to cart button -->

				<div id="add_to_cart">
					<input type="submit" name="add_to_cart" value='Add to Cart'>
				</div>

				</form>
			</div>
        

        </div>
            
            
       <?php include 'includes/sidenews.php'; ?> <!-- sidenews Of the page -->
        <div style="clear: both;"></div>
        <!--Comment Section Starts Here-->


            <div id = "comment">
                <div id = "comment_field">
                            <div id = "comment_header"><h1>Comment Section</h1></div>
                            <div>
                                
                                <form id = comment_form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?prod_id=<?php echo $product_id; ?>&amp;prod_name=<?php echo $table_name; ?>" method="post">
                                <input  type="text" name="comment" placeholder="Post Comment...." required>  
                                
                                <input class = "submit" type="submit" name="submit_comment" value="Comment">
                                    
                                  
                                </form>    
                            </div>
                
                
                            <div class="comment_content">
                                <div><h2>Comments:</h2></div>
                                <div>
                                    <?php
                                        $sql = "SELECT * FROM $table_name JOIN comment on comment.prod_id = $table_name.prod_id JOIN register on register.username = comment.username WHERE (comment.prod_id = '$product_id') AND (comment.cat_name = '$table_name') ORDER BY date DESC";
                                        $result = mysqli_query($con,$sql);

                                        if(mysqli_num_rows($result) == 0) {
                                            ?>
                                                <div style="padding: 20px;color: #a1a1a1;">No Comments Yet!</div>
                                            <?php
                                        }
                                        
                                        if (!$result){
                                                echo "<script>alert('Error')</script>";
                                            }else{
                                                while($row = mysqli_fetch_array($result)){
                                                 ?>
                    
                                      
                                            
                                            <div >
                                                <div style = "padding: 5px 0px;color: #405ba5;"><h3><?php echo $row['firstname'] ." ".$row['lastname']; ?></h3></div>
                                                <div  style = "margin-bottom:10px; color:#707275; border-bottom: 1px solid #d1d1d1;padding-bottom: 10px;">
                                                    <i><?php  echo $row['comment']; ?></i>
                                                    
                                                </div>
                                                
                                                <div id="individual_comment_content_reply">
                                                     <h3 style="padding: 10px 0px;">Reply:</h3>
                                                   
                                                    
                                                     <?php
                                                        
                                                        $cmnt_id = $row['cmnt_id'];
                                                        $sql1 = "SELECT * FROM reply JOIN register ON reply.username=register.username  where reply.cmnt_id='$cmnt_id'";
                                                        $result1 = mysqli_query($con,$sql1);
                                                        if (!$result1){
                                                            echo "Error In sql1 statement CHECK:".mysqli_error($con);
                                                        }else{
                                                            while($val = (mysqli_fetch_array($result1))){
                                                     ?> 
                                                        
                                                        <div class="individual_reply">
                                                          
                                                            <div class="individual_reply_content">
                                                                <div >
                                                                   <h3 style="padding: 5px 0px;color: #405ba5;"> <?php echo $val['firstname'] ." ". $val['lastname'] ?></h3>
                                                                </div>
                                                                <div style = "margin-bottom:10px; color:#707275" >
                                                                    <?php echo $val['reply_text']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                
                                                        
                                                    
                                                        <?php 
                                                    }
                                                }
                                                        ?>
                                                       
                                                    
                                                        <div  style = "margin-bottom:10px;">
                                                            <form id = "reply_form" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?prod_id=<?php echo $product_id; ?>&amp;prod_name=<?php echo $table_name; ?>' method="POST">
                                                                <input type='hidden' value='<?php echo $row['cmnt_id']?>' name='cmnt_id'>
                                                                <input type = "text" name="reply_text" placeholder="Reply Here..." required></input>
                                                                <input type="submit" name="reply" value="Reply">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            
                                            
                                        
                                        <?php
                                            
                                                
                                            }
                                ?>
                                            </div>
                                    </div>
                                           
                                    <?php }
                                        
                                    
                                    
                                    
                                    ?>
                                    
                                
                                
                                
                                
                                
                                
                                </div>
                            </div>
                                        
                                
              
            </div>
        </div>
           

        <?php include 'includes/footer.php'; ?> <!-- Footer of the page -->
         
    </body>



</html>
