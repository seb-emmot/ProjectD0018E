<html>
<body>

<?php 
$name = $_POST["name"];
$userpassword = $_POST["password"];

include 'connect.php';
$sql_name_avaliable = "SELECT * FROM account WHERE username='$name'";
$names = $conn->query($sql_name_avaliable);
$rows = $names->num_rows;
if ($rows == 1){
	echo "username is already taken!";
	
}
else{
	$sql = "INSERT INTO account (username, password)
	VALUES ('$name', '$userpassword')";
	
	if ($conn->query($sql) === TRUE) {
		echo "New Account created successfully";
		echo "Welcome $name;<br>";
		echo "Password is: $userpassword;<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


?>
<br>
go to <a href="registration.php">registration</a> page, or <br>
go to <a href="login.php">login</a> page

</body>
</html>
