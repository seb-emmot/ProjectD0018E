<html>
<body>

<?php 
$name = $_POST["name"];
$userpassword = $_POST["password"];

include 'connect.php';

$sql = "INSERT INTO account (username, password)
VALUES ('$name', '$userpassword')";

if ($conn->query($sql) === TRUE) {
	echo "New Account created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<br>
Welcome <?php echo $name; ?><br>
Password is: <?php echo $userpassword; ?><br>
go to <a href="login.php">login</a> page

</body>
</html>
