<?php session_start(); 
	if(!(isset($_SESSION["logged_in"]))) {
		$_SESSION["logged_in"] = false;
	}	
?>
<html>
<?php include 'HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
			<?php include 'HTMLelements/header.php'?>
			<div id="wrapper">
				<?php include 'HTMLelements/header_meny.php';?>		
				<div id="main">

				</div>
			</div>
			<div id="footer">
				footer
			</div>
	</div>
</body>
</html>