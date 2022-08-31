
<div id ="header">
	<a href = "index.php">
		<div id = "logo">
			<img src = "images/logoshop.png">
		</div>
	</a>
<div id = "link">

<?php 
    if( !isset($_SESSION['adminlogin']) ) {
        ?> 
            <ul>

                <?php 
                    if (isset($_SESSION['username'])){
                        $user_id = $_SESSION['user_id'];
                        $result = mysqli_query($con, "SELECT * FROM orders WHERE user_id='$user_id'");
                    
                        $lengthnot = mysqli_num_rows($result)

                        ?>
                            <li><a style="color: #ff6554; background: white;padding: 4px 10px;border-radius: 10px;" href="notifications.php">Notifications [ <?php echo $lengthnot;?> ]</a></li>
                        <?php
                    }
                ?>
                
                <?php
                
                if (isset($_SESSION['username'])){
                    $len = mysqli_num_rows(mysqli_query($con, "SELECT * FROM wishlist WHERE username='$username'"));
                    ?>


                <li><a href="view_wishlist.php">&#9825; WishList [ <?php echo $len; ?> ]</a></li>
                <?php
                }else{
                    ?>
                    <li><a href="signup.php">SignUp</a></li>
                <?php
                }
                    ?>
                
                <?php
                
                if (isset($_SESSION['username'])){
                    ?>
                <li>Logged in as <?php echo @$_SESSION['username'];?>&nbsp;&nbsp;&nbsp;<a href="logout.php">LogOut</a></li>
                <?php
                }else{
                    ?>
                    <li><a href="login.php">LogIn</a></li>
                <?php
                }
                    ?>
            </ul>
        <?php
    }
?>


</div>

<div id="searchandcart">
	<div id = "search">
		<form method ="post" action = "search.php">
			<input name = "search" type = "text" placeholder ="Search Here..." >
			<button name = "submit" id = "search_btn">Search</button>
		</form>
	</div>

    <?php 
        if( !isset($_SESSION['adminlogin']) ) {
            ?>
                <button id = "cart_btn" onclick="location.href='customercart.php'">Cart<?php
                    if(isset($_SESSION['product_name'])) {
                        echo ' ['.sizeof($_SESSION['product_name']).']';
                    } else {
                        echo ' [0]';
                    }
                ?></button>
            <?php 
        } else {
            ?>
                <div>Logged in as Admin</div>
            <?php
        }
    ?>
	

	<div style="clear: both;"></div>
</div>

</div>
