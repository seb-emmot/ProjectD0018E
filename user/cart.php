<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<script src="../Jscript/updateCartCounter.js"></script>
	<script src="../Jscript/deleteFromCart.js"></script>
	<script src="../Jscript/deleteWholeCart.js"></script>
	
	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					
					<?php 
					include '../resources/connect.php';
					$sql = "SELECT * FROM cart_items WHERE user_id = " . $_SESSION["id"];
					$cart = $conn->query($sql);//get cart associated to user
					if ($cart->num_rows > 0){
						
						echo '<div class="cartView">Product name:</div>';
						echo '<div class="cartView">Item-id:</div>';
						echo '<div class="cartView">Quantity:</div>';
						echo '<div class="cartView">Price/unit:</div>';
						$totPrice = 0;
						while ($row = $cart->fetch_assoc()){ //print out the items in cart
							$sql_products= "SELECT * FROM PRODUCTS WHERE item_id = " . $row["item_id"];
							$products = $conn->query($sql_products);
							$specs = $products->fetch_assoc();
							$totPrice = $totPrice + $specs["price"]*$row["quantity"];
							echo '<div id="div'.$row["item_id"].'">
									<div class="cartView"> '. $specs["name"] . '</div>';
							echo '<div class="cartView"> '. $row["item_id"].'</div>';
							echo '<div class="cartView"> '. $row["quantity"].'</div>';
							echo '<div class="cartPrice"> $'. $specs["price"].'</div>';
							echo '<div class="cartDelete" ><a class="productButton" href="#none">
									<div id="'.$row["item_id"].'" class="productBoxBuyButton">Remove</div></a></div></div>';
							
							echo '<script>document.getElementById("'.$row["item_id"].'").addEventListener("click", function() {
    									deleteFromCart('.$row["item_id"].');
									}, false);</script>';
						}
						echo '<div id="cartTotal">
									<div class="cartView"> Total:</div>';
						echo '<div class="cartView">  </div>';
						echo '<div class="cartView"> '.$_SESSION["itemsInCart"].'</div>';
						echo '<div class="cartPrice"> $'. $totPrice.'</div>';
						echo '<div class="cartDelete" ><a class="productButton" href="#none"><div id="delCart" class="productBoxBuyButton">Delete whole cart</div></a></div></div>';
							
						echo '<script>document.getElementById("delCart").addEventListener("click", function() {
    									deleteWholeCart();
									}, false);</script>';
						
			
						echo '<div id="cartCheckout"><a class="productButton" href="checkout.php"><div id="checkout" class="productBoxBuyButton">Checkout Cart</div></a></div>';
						
					}
					else {
						echo "You have no items in your shopping-cart!";
					}
					?>
					

					
					
				</div>
			</div>
			<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>
