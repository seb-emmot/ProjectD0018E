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
				<div class="productBoxStyling">
				<h1 id="welcomeh1">Welcome Dear Customer!</h1>
				<h2 id="welcomeText">On this website you can find alot of random stuff, stuff you won't even find on ebay!</h2>
				<br>
				<?php
				if($_SESSION["logged_in"] === false){
					echo '<p>Maybe you would like to check out our <a href="products/products.php">products?</a></p><br>';
					echo '<p> Or why not <a href="login/registration.php">create an account</a> of your own ?';
					echo 'This way you will not need to reenter your personal information when laying multiple orders.';
					echo 'Your shopping cart will also be saved permanently. But most importantly we can brag about having a lot of members!</p>';
					echo '<br>';
					echo '<p>';
					echo 'Are you already a member? Do not let us annoy you anymore, <a href="login/login.php">login here!</a></p>';
				}
				else{
					echo '<p>Not much more to do here, go check out the <a href="products/products.php">products?</a>';
				}
				?>
				</div>
			</div>
		</div>
		<?php include 'HTMLelements/footer.php';?>
	</div>
</body>
</html>