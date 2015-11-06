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
						<form action="reg_process.php" method="post">
						Name:<br> <input type="text" name="name"><br>
						Password:<br> <input type="text" name="password"><br>
						<input type="submit">
						</form> 
					</div>
				</div>
			</div>
	</div>
</body>
</html>
