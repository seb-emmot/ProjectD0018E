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
						$name = $_POST["name"];
						$userpassword = $_POST["password"];
						$sql = "SELECT * FROM account WHERE password='$userpassword' AND username='$name'";
						$account = $conn->query($sql);
						//echo $account;
						$rows = $account->num_rows;
						if ($rows == 1){
							//confirmed
							echo "confirmed";
							$_SESSION["username"] = $name;
							$_SESSION["logged_in"] = true;
						}
						else{
							echo "Username or password is not correct!";
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
