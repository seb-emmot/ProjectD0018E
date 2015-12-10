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
			
			if (sizeof($_SESSION["shopping_cart"]) > 0){
				$sql_delete_old_cart = "DELETE FROM cart_items WHERE user_id =". $_SESSION["id"];
				$conn->query($sql_delete_old_cart);
				for ($i = 0;$i< sizeof($_SESSION["shopping_cart"]); $i++){
					$u_id = $_SESSION["id"];
					$i_id = $_SESSION["shopping_cart"][$i][0];
					$quantity = $_SESSION["shopping_cart"][$i][1];
					$sql_add_new_cart = "INSERT INTO cart_items (`user_id`, `item_id`, `quantity`) VALUES ($u_id, $i_id, $quantity)";
					$conn->query($sql_add_new_cart);
				}
			}
			
			$sql_cart_items = "SELECT * FROM cart_items WHERE user_id=".$_SESSION["id"];
			$items = $conn->query($sql_cart_items);
			$numOfItems = 0;
			while ($row = $items->fetch_assoc()){
				$numOfItems = $numOfItems + $row["quantity"];
			}
			$_SESSION["itemsInCart"] = $numOfItems;
			header("Location: ../user/profile.php");
			die();
		}
		else{
			$_SESSION["login_text"] = "E-mail or password is incorrect!\n";
			header("Location: login.php");
			die();
		}
		?>

