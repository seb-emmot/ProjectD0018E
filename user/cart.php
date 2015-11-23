<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<script type="text/javascript">
		$(function(){
			$("#deleteShoppingCart").click(function(){
					$.ajax({
					   url: "../SQLcalls/delete_whole_cart.php",
					   success: function(){
						 document.getElementById("main").innerHTML = "Shoppingcart deleted!";
					   }
					 });
				});
		});

		$(function(){
			$(".deleteItem").click(function(){
					var itemId = $(this).attr('id');
					
					$.ajax({
					   url: "../SQLcalls/delete_from_cart.php",
					   type: "GET",
					   data: {itemid: itemId},
					   success: function(data){
							if(data){
								document.getElementById("main").innerHTML = "Shoppingcart deleted!";
							}
							else{
								var element = document.getElementById("div"+itemId);
								element.parentNode.removeChild(element);
							}
							   
						   
					   }
					 });
				});
		});
		
	</script>
	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					
					<?php 
					include '../resources/connect.php';
					$sql = "SELECT * FROM CART WHERE user_id = " . $_SESSION["id"];
					$cart = $conn->query($sql);//get cart associated to user
					if ($cart->num_rows == 1){
						$cart_row = $cart->fetch_assoc(); //get all variables from cart table matching.
						$_SESSION["c_id"] = $cart_row["cart_id"];//get cart-id
						$sql_get_items = "SELECT * FROM CART_ITEMS WHERE cart_id = " . $_SESSION["c_id"];
						$_SESSION["items"] = $conn->query($sql_get_items);//gather items-id from cart
						echo '<div class="cartView">Product name:</div>';
						echo '<div class="cartView">Item-id:</div>';
						echo '<div class="cartView">Quantity:</div>';
						echo '<div class="cartView">Price/unit:</div>'; 
						$id_counter = 0;
						while ($row = $_SESSION["items"]->fetch_assoc()){ //print out the items in cart
							$sql_products= "SELECT * FROM PRODUCTS WHERE item_id = " . $row["item_id"];
							$products = $conn->query($sql_products);
							$specs = $products->fetch_assoc();
							$_SESSION["i_id"]= $row["item_id"];
							$id_counter++;
							echo '<div id="div'.$_SESSION["i_id"].'"><div class="cartView"> '. $specs["name"] . '</div>';
							$id_counter++;
							echo '<div class="cartView"> '. $row["item_id"].'</div>';
							$id_counter++;
							echo '<div class="cartView"> '. $row["quantity"].'</div>';
							$id_counter++;
							echo '<div class="cartPrice"> '. $specs["price"].'</div>';
							echo '<div class="cartDelete" ><button class="deleteItem" type="button" id="'.$_SESSION["i_id"].'" data-role="button">remove</button></div></div>';
						}
						echo '<button id="deleteShoppingCart" type="button" data-role="button">Clear shopping-cart</button>';
						
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
