<html>
<body>

<?php
include 'connect.php';
$name = $_POST["name"];
$userpassword = $_POST["password"];
$sql = "SELECT * FROM account WHERE password='$userpassword' AND username='$name'";
$account = $conn->query($sql);
//echo $account;
$rows = $account->num_rows;
if ($rows == 1){
	//confirmed
	echo "confirmed";
}
else{
	echo "Username or password is not correct!";
}

?>

</body>
</html>