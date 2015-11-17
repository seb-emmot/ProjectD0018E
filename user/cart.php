<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					<?php 
					include '../resources/connect.php';
					$sql = "SELECT cart-id FROM CART WHERE user-id = " . $_SESSION["id"];
					$cart = $conn->query($sql); //get cart associated to user
					$cart_row = $cart->fetch_assoc(); //get all variables
					$cart_id = $cart_row["cart-id"];
					$sql_get_items = "SELECT item-id FROM CART_ITEMS WHERE user-id = " . $cart_id;
					$items = $conn->query($sql_get_items);
					if ($items->num_rows > 0){
						while ($row = $items->fetch_assoc()){
							echo $row["item-id"] . "\n";
						}
						
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