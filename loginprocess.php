<html>
<body>

<?php
include 'connect.php';
$name = $_POST["name"];
$userpassword = $_POST["password"];
$sql = "SELECT * FROM account WHERE password='$userpassword' AND username='$name', $conn";
$account = mysql_query($sql);
echo $account;
$rows = mysql_num_rows($account);
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