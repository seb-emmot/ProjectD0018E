<?php 
session_start();
?>
<html>
<?php include 'HTMLelements/header.php';?>
<body>

	<div id="pagewrapper">
			<div id="header">
			</div>
			<div id="wrapper">
				<?php include 'HTMLelements/header_meny.php';?>		
				<div id="main">
					<div id="loginbox">
						<form action="loginprocess.php" method="post">
						Enter your account information to login:<br>
						Name:<br> <input type="text" name="name"><br>
						Password:<br> <input type="text" name="password"><br>
						<input type="submit">
						</form>
						<br>
						Don't have an account? <a href="Registration.php">Register Here</a>
					</div>
				</div>
			</div>
	</div>
</body>
</html>
