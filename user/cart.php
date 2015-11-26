<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<script src="../Jscript/updateCartCounter.js"></script>
	<script type="text/javascript">
	function deleteItem(itemId){
		$.ajax({
			   url: "../SQLcalls/deleteFromCart.php",
			   type: "GET",
			   data: {itemid: itemId},
			   dataType: "json",
			   success: function(data){
				    updateCartCounter(data[1]);
					if(data[0] == true){
						document.getElementById("main").innerHTML = "Shoppingcart deleted!";
					}
					else{
						var element = document.getElementById("div"+itemId);
						element.parentNode.removeChild(element);
					}
					   
				   
			   }
			 });
	}
	function deleteWholeCart(){
		$.ajax({
			   url: "../SQLcalls/deleteWholeCart.php",
			   dataType: "json",
			   success: function(items){
				 document.getElementById("main").innerHTML = "Shoppingcart deleted!";
				 updateCartCounter(items);
			  }
		});
	}
	
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
							echo '<div class="cartDelete" ><button class="deleteItem" type="button" id="'.$row["item_id"].'">remove</button></div></div>';
							echo '<script>document.getElementById("'.$row["item_id"].'").addEventListener("click", function() {
    									deleteItem('.$row["item_id"].');
									}, false);</script>';
						}
						echo '<button id="deleteWholeCart" type="button" data-role="button">Clear shopping-cart</button>';
						echo '<script>document.getElementById("deleteWholeCart").addEventListener("click", function() {
    									deleteWholeCart();
									}, false);</script>';
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
