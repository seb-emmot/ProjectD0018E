<?php session_start(); 
	include '../../resources/connect.php';
	$name = $_POST["name"];
	$userpassword = $_POST["password"];
	$sql = "SELECT * FROM ADMIN_ACCOUNTS WHERE password='$userpassword' AND name='$name'";
	$account = $conn->query($sql);
	//echo $account;
	$rows = $account->num_rows;
	if ($rows == 1){
		//confirmed.. establish session variables for user
		$info = $account->fetch_assoc();
		$_SESSION["id"] = $info["admin_id"];
		$_SESSION["adminname"] = $name;
		$_SESSION["admin"] = true;

		header("Location: ../admin.php");
		die();
	}
	else{
		header("Location: ../adminLogin.php");
		die();
	}
?>