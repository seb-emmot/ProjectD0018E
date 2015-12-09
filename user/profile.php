<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					<script type="text/javascript" src="../Jscript/changeInfo.js"></script>
					<script type="text/javascript" src="../Jscript/displayOrder.js"></script>
					<script type="text/javascript" src="../Jscript/printProducts.js"></script>
					<div class="productBoxStyling">
					<b>Contact Information:</b><br><br>
					<?php 
						include '../resources/connect.php';
						$sql_get_info = "SELECT * FROM ACCOUNTS WHERE user_id =". $_SESSION["id"];
						$info = $conn->query($sql_get_info);
						$info = $info->fetch_assoc();
						
						echo '<div id="e_mail" class="contactInfo">';
						echo 'E-mail: '.$info["e_mail"];
						echo '</div><div class="changeInfo"><img src="../resources/pictures/wrench-hi.png" alt="change"  height="15px" width="15px" id="first"></div><br>';
						
						echo '<div id="fname" class="contactInfo">';
						if ($info["fname"] != NULL){echo 'First name: '.$info["fname"];}
						else {echo 'First name: Not set!';}
						echo '</div><div class="changeInfo"><img src="../resources/pictures/wrench-hi.png" alt="change"  height="15px" width="15px" id="second"></div><br>';
						
						echo '<div id="lname" class="contactInfo">';
						if ($info["lname"] != NULL){echo 'Last name: '.$info["lname"];}
						else {echo 'Last name: Not set!';}
						echo '</div><div class="changeInfo"><img src="../resources/pictures/wrench-hi.png" alt="change"  height="15px" width="15px" id="third"></div><br>';
						
						echo '<div id="address" class="contactInfo">';
						if ($info["address"] != NULL){echo 'Address: '.$info["address"];}
						else {echo 'Address: Not set!';}
						echo '</div><div class="changeInfo"><img src="../resources/pictures/wrench-hi.png" alt="change"  height="15px" width="15px" id="fourth"></div><br>';
						
						echo '<div id="password" class="contactInfo">';
						echo 'Password: '.$info["password"];
						echo '</div><div class="changeInfo"><img src="../resources/pictures/wrench-hi.png" alt="change"  height="15px" width="15px" id="sixth"></div><br>';
						
						echo '<div id="reg_date" class="contactInfo">';
						if ($info["reg_date"] != NULL){echo 'Registration date: '.$info["reg_date"];}
						else {echo 'Registration date: Not set!';}
						echo '</div><br>';
						
						
					?>
					</div>
					<br>
					<script>document.getElementById("first").addEventListener("click", function() {
		    									changeInfo("e_mail", "first");
											}, false);</script>
					<script>document.getElementById("second").addEventListener("click", function() {
											changeInfo("fname", "second");
										}, false);</script>
					<script>document.getElementById("third").addEventListener("click", function() {
											changeInfo("lname", "third");
										}, false);</script>
					<script>document.getElementById("fourth").addEventListener("click", function() {
											changeInfo("address", "fourth");
										}, false);</script>
					<script>document.getElementById("sixth").addEventListener("click", function() {
											changeInfo("password", "sixth");
										}, false);</script>
					
					<div id="orderHistory" class="productBoxStyling">
					<b>Order History:</b><br>
						<?php 
						$sql = "SELECT * FROM orders WHERE user_id = " . $_SESSION["id"];
						$orders = $conn->query($sql);//get orders associated to user
						if ($orders->num_rows > 0){
							echo '<div class="orderView">Order-id:</div>';
							echo '<div class="orderView">Order date:</div>';
							echo '<div class="orderView">Price($):</div>';
							while ($row = $orders->fetch_assoc()){
								echo '<div id="'.$row["order_id"].'" class="orderContainer"><div class="orderView">'.$row["order_id"].'</div>';
								echo '<div class="orderView">'.$row["date"].'</div>';
								echo '<div class="orderView">'.$row["price"].'<div><a id="'.$row["order_id"].'items">+</a></div></div></div>';
								echo '<script>$("#'.$row["order_id"].'items").css("cursor", "pointer");
								document.getElementById("'.$row["order_id"].'items").addEventListener("click", function() {
											displayOrder("'.$row["order_id"].'");
										}, false);</script>';
							}
						}
						else {
							echo 'No orders laid.';
						}
						?>
						</div><br>
						
						<div id="rankedProducts" class="productBoxStyling">
						<b>Products you have ranked:</b>
							<?php 
								$sql = "SELECT item_id, rating FROM reviews WHERE user_id = " . $_SESSION["id"];
								$reviews = $conn->query($sql);//get reviews associated to user
								if ($reviews->num_rows > 0){
									echo '<div class="ratedProduct"><div class="productNameProfile">Name:</div><div class="productRatingProfile">Rating:</div><br>';
									while ($row = $reviews->fetch_assoc()){
										$sql = "SELECT name FROM products WHERE item_id = " . $row["item_id"];
										$name = $conn->query($sql);
										$name = $name->fetch_assoc();
										$name = $name["name"];
										$rating = $row["rating"];
										$item_id = $row["item_id"];
										echo '<script>
												printProducts("'.$name.'",'.$rating.','.$item_id.');
											</script>';
										
									}
									echo '</div>';
								}
								else {
									echo 'None.';
								}
							?>
						</div>
					</div>
				</div>
				
			</div>
			<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>