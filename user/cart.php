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
					if ($_SESSION["logged_in"]){
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
					}
					else {
						if (sizeof($_SESSION["shopping_cart"]) > 0){
							$sCart = $_SESSION["shopping_cart"];
							echo '<div class="cartView">Product name:</div>';
							echo '<div class="cartView">Item-id:</div>';
							echo '<div class="cartView">Quantity:</div>';
							echo '<div class="cartView">Price/unit:</div>';
							$totPrice = 0;
							for ($i = 0;$i< sizeof($sCart); $i++ ){ //print out the items in cart
								$sql_products= "SELECT * FROM PRODUCTS WHERE item_id = " . $sCart[$i][0];
								$products = $conn->query($sql_products);
								$specs = $products->fetch_assoc();
								$totPrice = $totPrice + $specs["price"]*$sCart[$i][1];
								echo '<div id="div'.$sCart[$i][0].'">
										<div class="cartView"> '. $specs["name"] . '</div>';
								echo '<div class="cartView"> '. $sCart[$i][0].'</div>';
								echo '<div class="cartView"> '. $sCart[$i][1].'</div>';
								echo '<div class="cartPrice"> $'. $specs["price"].'</div>';
								echo '<div class="cartDelete" ><a class="productButton" href="#none">
										<div id="'.$sCart[$i][0].'" class="productBoxBuyButton">Remove</div></a></div></div>';
						
								echo '<script>document.getElementById("'.$sCart[$i][0].'").addEventListener("click", function() {
	    									deleteFromCart('.$sCart[$i][0].');
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
					}
					?>
					

					
					
				</div>
			</div>
			<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>
