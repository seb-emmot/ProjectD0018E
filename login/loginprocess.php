<?php session_start(); ?>
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
			
			$_SESSION["username"] = $name;
			$_SESSION["logged_in"] = true;
			header("Location: ../user/profile.php");
			die();
		}
		else{
			$_SESSION["login_text"] = "Username or password is incorrect!\n";
			header("Location: login.php");
			die();
		}
		?>

