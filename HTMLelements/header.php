
<div id="header">
	<div id="header-container">
		<div id="logo-container">
				<div id="logo"><img alt="Logo" src="../resources/pictures/apple.png"><p>E<br>-<br>M<br>A<br>R<br>T</p></div>
		</div>
		<div id="searchfieldContainer">
			<div id="searchfield">
				<form action="/ProjectD0018E/products/products.php" method="get">
					<input class="searchfieldInput" type ="text" name="search">
					<input class="searchfieldButton" type="submit">
				</form>			
			</div>
		</div>
		<div id="identityContainer">
			<div id="identitybox">
			<?php
				if(!isset($_SESSION["shopping_cart"])){
					$_SESSION["shopping_cart"] = array();
				}
				if(!isset($_SESSION["itemsInCart"])){
					$_SESSION["itemsInCart"] = 0;
				}
				if($_SESSION["logged_in"] == true) {
					echo 'Welcome '.$_SESSION["username"].'! | ';
					echo '<a class="ib" href="/ProjectD0018E/user/profile.php">Profile</a>
					|
					<a class="ib" id="cartLink" href="/ProjectD0018E/user/cart.php">Cart('.$_SESSION["itemsInCart"].')</a>
					|
					<a class="ib" href="/ProjectD0018E/login/logout.php">Logout</a>';
				}
				else {
					echo '<a class="ib" href="/ProjectD0018E/login/login.php">Login</a>
					|
					<a class="ib" href="/ProjectD0018E/login/registration.php">Register</a>
					|
					<a class="ib" id="cartLink" href="/ProjectD0018E/user/cart.php">Cart('.$_SESSION["itemsInCart"].')</a>';
				}			
			?>
			</div>
		</div>
		<div id="notificationPopup"></div>
	</div>
</div>
<script type="text/javascript" src="../Jscript/headerSetup.js"></script>
