<html>
	<?php include '../HTMLelements/header.php';?>
<body>
	<div id="pagewrapper">
			<div id="header">
			</div>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					<div id="loginbox">
						<?php 
							$name = $_POST["name"];
							$userpassword = $_POST["password"];
							
							include '../resources/connect.php';
							$sql = "INSERT INTO account (username, password)
							VALUES ('$name', '$userpassword')";
								
							if ($conn->query($sql) === TRUE) {
								echo "New Account created successfully";
								echo "Welcome $name;<br>";
								echo "Password is: $userpassword;<br>";
							} else {
								echo "Username already taken.";
							}
							
							
							
						?>
						<br>
						go to <a href="registration.php">registration</a> page, or <br>
						go to <a href="login.php">login</a> page
					</div>
				</div>
			</div>
			<div id="footer">
				footer
			</div>
	</div>
</body>
</html>
