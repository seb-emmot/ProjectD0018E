<?php session_start(); ?>
	<?php
		include '../resources/connect.php';
		$name = $_POST["name"];
		$userpassword = $_POST["password"];
		$sql = "SELECT * FROM ACCOUNTS WHERE password='$userpassword' AND e_mail='$name'";
		$account = $conn->query($sql);
		//echo $account;
		$rows = $account->num_rows;
		if ($rows == 1){
			//confirmed.. establish session variables for user
			$info = $account->fetch_assoc();
			$_SESSION["id"] = $info["user_id"];
			$_SESSION["username"] = $name;
			$_SESSION["logged_in"] = true;
			$sql_cart_items = "SELECT * FROM cart_items WHERE user_id=".$_SESSION["id"];
			$items = $conn->query($sql_cart_items);
			$_SESSION["itemsInCart"] = $items->num_rows;
			header("Location: ../user/profile.php");
			die();
		}
		else{
			$_SESSION["login_text"] = "E-mail or password is incorrect!\n";
			header("Location: login.php");
			die();
		}
		?>

