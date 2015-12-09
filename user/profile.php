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
					<b>Contact Information:</b><br><br>
					<?php 
						include '../resources/connect.php';
						$sql_get_info = "SELECT * FROM ACCOUNTS WHERE user_id =". $_SESSION["id"];
						$info = $conn->query($sql_get_info);
						$info = $info->fetch_assoc();
						
						echo '<div id="e_mail" class="contactInfo">';
						echo 'E-mail: '.$info["e_mail"];
						echo '<div class="changeInfo"><a id="first" href="#none">change</a></div></div>';
						
						echo '<div id="fname" class="contactInfo">';
						if ($info["fname"] != NULL){echo '<br>First name: '.$info["fname"];}
						else {echo 'First name: Not set!';}
						echo '<div class="changeInfo"><a id="second" href="#none">change</a></div></div>';
						
						echo '<div id="lname" class="contactInfo">';
						if ($info["lname"] != NULL){echo '<br>Last name: '.$info["lname"];}
						else {echo 'Last name: Not set!';}
						echo '<div class="changeInfo"><a id="third" href="#none">change</a></div></div>';
						
						echo '<div id="address" class="contactInfo">';
						if ($info["address"] != NULL){echo '<br>Address: '.$info["address"];}
						else {echo 'Address: Not set!';}
						echo '<div class="changeInfo"><a id="fourth" href="#none">change</a></div></div>';
						
						echo '<div id="reg_date" class="contactInfo">';
						if ($info["reg_date"] != NULL){echo '<br>Registration date: '.$info["reg_date"];}
						else {echo 'Registration date: Not set!';}
						echo '<div class="changeInfo"><a id="fifth" href="#none">change</a></div></div>';
						
						echo '<div id="password" class="contactInfo">';
						echo '<br>Password: '.$info["password"];
						echo '<div class="changeInfo"><a id="sixth" href="#none">change</a></div></div>';
					?>
					<br>
					<script>document.getElementById("first").addEventListener("click", function() {
		    									changeInfo("e_mail");
											}, false);</script>
					<script>document.getElementById("second").addEventListener("click", function() {
											changeInfo("fname");
										}, false);</script>
					<script>document.getElementById("third").addEventListener("click", function() {
											changeInfo("lname");
										}, false);</script>
					<script>document.getElementById("fourth").addEventListener("click", function() {
											changeInfo("address");
										}, false);</script>
					<script>document.getElementById("fifth").addEventListener("click", function() {
											changeInfo("reg_date");
										}, false);</script>
					<script>document.getElementById("sixth").addEventListener("click", function() {
											changeInfo("password");
										}, false);</script>
					
					<div id=orderHistory>
						<?php 
						$sql = "SELECT * FROM orders WHERE user_id = " . $_SESSION["id"];
						$orders = $conn->query($sql);//get cart associated to user
						if ($orders->num_rows > 0){
							echo '<div class="orderView">Order-id:</div>';
							echo '<div class="orderView">Order date:</div>';
							echo '<div class="orderView">Price:</div>';
							while ($row = $orders->fetch_assoc()){
								echo '<div id="'.$row["order_id"].'" class="orderContainer"><div class="orderView">'.$row["order_id"].'</div>';
								echo '<div class="orderView">'.$row["date"].'</div>';
								echo '<div class="orderView">'.$row["price"].'<a id="'.$row["order_id"].'items">+</a></div></div>';
								echo '<script>document.getElementById("'.$row["order_id"].'items").addEventListener("click", function() {
											displayOrder("'.$row["order_id"].'");
										}, false);</script>';
							}
						}
						?>
						
					</div>
				</div>
				
			</div>
			<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>