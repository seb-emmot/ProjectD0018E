<?php session_start(); ?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>

	<div id="pagewrapper">
			<?php include '../HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include '../HTMLelements/header_meny.php';?>		
				<div id="main">
					<div id="loginbox">
						<?php 
						if((isset($_SESSION["login_text"]))) {
							echo $_SESSION["login_text"];
							unset($_SESSION["login_text"]);
						}
						?>
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
			<div id="footer">
				footer
			</div>
	</div>
</body>
</html>
