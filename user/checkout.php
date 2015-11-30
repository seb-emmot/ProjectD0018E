<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					Confirm that theese are the items you want to order.<br>
					<?php 
					include '../resources/connect.php';
					$sql = "SELECT * FROM cart_items WHERE user_id = " . $_SESSION["id"];
					$cart = $conn->query($sql);//get cart associated to user
					
					echo '<div class="cartView">Product name:</div>';
					echo '<div class="cartView">Item-id:</div>';
					echo '<div class="cartView">Quantity:</div>';
					echo '<div class="cartView">Price/unit:</div>';
					$totPrice = 0;
					while ($row = $cart->fetch_assoc()){ //print out the items in cart
						$sql_products= "SELECT * FROM PRODUCTS WHERE item_id = " . $row["item_id"];
						$products = $conn->query($sql_products);
						$specs = $products->fetch_assoc();
						$totPrice = $totPrice + $specs["price"];
						echo '<div id="div'.$row["item_id"].'">
								<div class="cartView"> '. $specs["name"] . '</div>';
						echo '<div class="cartView"> '. $row["item_id"].'</div>';
						echo '<div class="cartView"> '. $row["quantity"].'</div>';
						echo '<div class="cartPrice"> $'. $specs["price"].'</div>';
						echo '<div class="cartDelete" > </div></div>';
						}
					echo '<div id="cartTotal">
									<div class="cartView"> Total:</div>';
					echo '<div class="cartView">  </div>';
					echo '<div class="cartView"> '.$_SESSION["itemsInCart"].'</div>';
					echo '<div class="cartPrice"> $'. $totPrice.'</div>';
					echo '<div class="cartDelete" > </div></div>';
						
			
					echo '<div id="cartCheckout"><a class="productButton" href="checkout.php"><div id="checkout" class="productBoxBuyButton">Confirm and pay</div></a></div>';
					echo '<script>document.getElementById("checkout").addEventListener("click", function() {
    									checkoutCart();
									}, false);</script>';
					
					
					?>
				</div>
			</div>
			<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>
