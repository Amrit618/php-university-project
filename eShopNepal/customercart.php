<?php
	include 'includes/connect.php';

	session_start();

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

		<style>
			#modal {
				position: absolute;
				left: 0;
				right: 0;
				bottom: 0;
				top: 0;
				background: rgba(0,0,0,0.6);
				display: none;
			}

			#modal #modal_container {
				background: white;
				width: 80%;
				margin: 50px auto;
				border-radius: 4px;
				padding: 20px;
				animation: modalAnimation 0.6s;
				position: relative;
			}

			@keyframes modalAnimation {
				from {
					transform: translateY(-200px);
					opacity: 0.6;
				}

				to {
					transform: translateY(0px);
					opacity: 1;
				}
			}

			#modal #modal_container #buynow_button {
				padding: 15px;
				font-size: 20px;
				border: none;
				outline: none;
				background: #39f;
				color: white;
				border-radius: 4px;
				box-shadow: 1px 1px 2px rgba(0,0,0,0.2);
				cursor: pointer;
				width: 150px;
				display: block;
				margin: auto;
			}

			#modal #modal_container #buynow_button:hover {
				background: #16C;
			}

			#close_button {
				background: #ff6d59;
				border-radius: 50%;
				width: 20px;
				height: 20px;
				line-height: 8px;
				border: none;
				outline: none;
				box-shadow: 1px 1px 2px rgba(0,0,0,0.2);
				cursor: pointer;
				color: white;
				position: absolute;
				right: 15px;
				top: 15px;
			}

			#esewa_input {
				display: none;
			}

			#modal_header {
				padding: 0px 0px 20px 0px;
				border-bottom: 1px solid #e1e1e1;
				margin-bottom: 20px;
			}

			#modal_section {
				height: 200px;
			}

			select, input[type="text"] {
				padding: 6px;
				width: 50%;
				margin-bottom: 20px;
			}

			#info {
				text-align: center;
				color: #999;
				margin-top: 50px;
			}
		</style>
    </head>
    <body>

		<div id="modal">
			<div id="modal_container">

				<div id="modal_header">
					Select your payment type:
				</div>

				<div id="modal_section">
					<form>
						<select onchange="selectPayment()" id="paymenttype">
							<option selected disabled>Choose your payment type:</option>
							<option value="cash">Cash On Delivery</option>
							<option value="esewa" disabled>Esewa</option>
						</select>
					</form>

					<div id="esewa_input">
						<input type="text" placeholder="Enter esewa ID">
					</div>

					<div id="info">
						Your product will be delivered within 2 days after you placed your order.
					</div>
				</div>

				<button id="close_button">&times;</button>
				<button onclick="location.href='checkout.php'" id="buynow_button">BUY NOW</button>
			</div>
		</div>

		<?php include 'includes/header.php'; ?> <!-- Header of the page -->

        <?php include 'includes/navbar.php'; ?> <!-- Navigation bar of the page -->

        <div id = "bodyleft">
			<?php
				if(empty($_SESSION['product_name'])) {
					?>
						<div id="empty_cart">
							Your cart is empty!
						</div>
					<?php
				} else {
					for($i=0;$i<sizeof($_SESSION['product_name']);$i++) {
						?>
							<div class='individual_products'> <!-- For individual items -->

								<div class="individual_products_image">
									<img src="images/<?php echo $_SESSION['product_image'][$i]; ?>">
								</div>

								<div class="individual_products_nameanddate">
									<?php
										echo $_SESSION['product_name'][$i].'<br>';
										echo '<span style="font-size: 14px;font-weight: normal;">Date: '.$_SESSION['date_added'][$i].'</span>';
									?>
								</div>

								<div class="individual_products_priceandlocation">
									<?php
										echo '<span style="font-weight: bold;color: javascript:void(0)222;">Price:</span> '.$_SESSION['product_price'][$i].'<br>';
										echo '<span style="font-weight: bold;color: javascript:void(0)222;">Location:</span> '.$_SESSION['location'][$i].'<br>';
									?>
								</div>

								<div class="individual_products_quantity">
									<?php
										echo '<span style="font-weight: bold;color: javascript:void(0)222;">Quantity:</span> '.$_SESSION['product_quantity'][$i].'';
									?>
								</div>

								<div class="individual_products_delete">
									<a href="destroy_specific.php?specific_id=<?php echo $i; ?>">Delete</a>
								</div>

								<div style="clear: both;"></div>
							</div>
						<?php
					}
				}
			?>

			<?php
				if(!empty($_SESSION['product_name'])) {
					?>
						<div id="checkandclear">
							<a href="clear_cart.php">Clear Cart</a>

							<!-- <a href="checkout.php">Check Out</a> -->
							<a id="checkout_button">Check Out</a>
						</div>
					<?php
				}
			?>
		</div>

		<?php include 'includes/sidenews.php'; ?> <!-- sidenews Of the page -->

		<?php include 'includes/footer.php'; ?> <!-- Footer of the page -->

		<script>
			function selectPayment() {
				let paymentType = document.getElementById("paymenttype").value;
				const esewaInput = document.getElementById("esewa_input");
				// console.log(paymentType);

				if(paymentType == "esewa") {
					esewaInput.style.display = 'block';
				} else if(paymentType == "cash") {
					esewaInput.style.display = 'none';
				}
			}

			function firstFunction() {

				const modal = document.getElementById("modal");
				const buyNowButton = document.getElementById("buynow_button");
				const checkOutButton = document.getElementById("checkout_button");
				const closeButton = document.getElementById("close_button");

				modal.addEventListener("click", (event) => {
					if(event.target === event.currentTarget) {
						modal.style.display = 'none';
					}
				});

				checkOutButton.addEventListener("click", () => {
					modal.style.display = 'block';
				});

				closeButton.addEventListener("click", () => {
					modal.style.display = 'none';
				});
			}

			window.addEventListener("load", firstFunction);
		</script>
    </body>
</html>
