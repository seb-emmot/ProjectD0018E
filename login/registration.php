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
						if((isset($_SESSION["registration_text"]))) {
							echo $_SESSION["registration_text"];
							unset($_SESSION["registration_text"]);
						}
						?>
						<form action="reg_process.php" method="post">
						Name:<br> <input type="text" name="name"><br>
						Password:<br> <input type="text" name="password"><br>
						<input type="submit">
						</form> 
					</div>
				</div>
			</div>
			<div id="footer">
				footer
			</div>
	</div>
</body>
</html>
