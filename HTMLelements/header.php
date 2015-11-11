
<div id="header">
	<div id="header-container">
		<div id="logo-container">
				
		</div>
		
		<div id="searchfield">
			
		</div>
		
		<div id="identitybox">
		<?php 		
			if($_SESSION["logged_in"] == true) {
				echo 'Welcome '.$_SESSION["username"].'! | ';
				echo '<a class="ib" href="/ProjectD0018E/user/profile.php">Profile</a>
				|
				<a class="ib" href="/ProjectD0018E/user/cart.php">Cart</a>
				|
				<a class="ib" href="/ProjectD0018E/login/logout.php">Logout</a>';
			}
			else {
				echo '<a class="ib" href="/ProjectD0018E/login/login.php">Login</a>
				|
				<a class="ib" href="/ProjectD0018E/login/registration.php">Register</a>';
			}			
		?>
		
		</div>
	</div>
</div>