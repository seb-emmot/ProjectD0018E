<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<script src="../Jscript/updateCartCounter.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#deleteShoppingCart").click(function(){
					$.ajax({
					   url: "../SQLcalls/deleteWholeCart.php",
					   success: function(){
						 document.getElementById("main").innerHTML = "Shoppingcart deleted!";
						 updateCartCounter(<?php echo $_SESSION["itemsInCart"];?>);
					   }
					 });
				});
		});

		$(function(){
			$(".deleteItem").click(function(){
					var itemId = $(this).attr('id');
					$.ajax({
					   url: "../SQLcalls/deleteFromCart.php",
					   type: "GET",
					   data: {itemid: itemId},
					   success: function(isEmpty){
						    updateCartCounter(<?php echo $_SESSION["itemsInCart"];?>);
							if(isEmpty == "true"){
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
					$sql = "SELECT * FROM cart_items WHERE user_id = " . $_SESSION["id"];
					$cart = $conn->query($sql);//get cart associated to user
					if ($cart->num_rows > 0){
						
						echo '<div class="cartView">Product name:</div>';
						echo '<div class="cartView">Item-id:</div>';
						echo '<div class="cartView">Quantity:</div>';
						echo '<div class="cartView">Price/unit:</div>';
						while ($row = $cart->fetch_assoc()){ //print out the items in cart
							$sql_products= "SELECT * FROM PRODUCTS WHERE item_id = " . $row["item_id"];
							$products = $conn->query($sql_products);
							$specs = $products->fetch_assoc();
							echo '<div id="div'.$row["item_id"].'">
									<div class="cartView"> '. $specs["name"] . '</div>';
							echo '<div class="cartView"> '. $row["item_id"].'</div>';
							echo '<div class="cartView"> '. $row["quantity"].'</div>';
							echo '<div class="cartPrice"> '. $specs["price"].'</div>';
							echo '<div class="cartDelete" ><button class="deleteItem" type="button" id="'.$row["item_id"].'" data-role="button">remove</button></div></div>';
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
