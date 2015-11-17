<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					<div id="cart_view">
						hej
					</div>
					<?php 
					include '../resources/connect.php';
					$sql = "SELECT * FROM CART WHERE user_id = " . $_SESSION["id"];
					$cart = $conn->query($sql); //get cart associated to user
					$cart_row = $cart->fetch_assoc(); //get all variables from cart table matching.
					$cart_id = $cart_row["cart_id"];//get cart-id
					$sql_get_items = "SELECT * FROM CART_ITEMS WHERE cart_id = " . $cart_id;
					$items = $conn->query($sql_get_items);//gather items-id from cart
					if ( $items->num_rows > 0){
						while ($row = $items->fetch_assoc()){ //print out the items in cart
							$sql_products= "SELECT * FROM PRODUCTS WHERE item_id = " . $row["item_id"];
							$products = $conn->query($sql_products);
							$specs = $products->fetch_assoc();
							echo "name: " . $specs["name"] . "\t item-id: " . $row["item_id"] . "\t quantity: " .$row["quantity"] . "\t price: " . $specs["price"] ."\n";
								
						}
						
					}
					else {
						echo "You have no items in your shopping-cart!";
					}
					?>
				</div>
			</div>
			<div id="footer">
				footer
			</div>
	</div>
</body>
</html>
