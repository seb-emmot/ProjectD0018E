<?php
	include '../resources/connect.php';
	$name = $_POST["quanity"];
	$userpassword = $_POST["password"];
	$sql = "SELECT * FROM ACCOUNTS WHERE password='$userpassword' AND e_mail='$name'";
	$account = $conn->query($sql);
?>