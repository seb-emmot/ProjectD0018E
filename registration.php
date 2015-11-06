<html>
<body>

<form action="registration.php" method="post">
Name: <input type="text" name="name"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>

<?php 
$name = $_POST["name"];
$userpassword = $_POST["password"];

include 'connect.php';

$sql = "INSERT INTO account (username, password, id)
VALUES ('$name', '$userpassword', '1')";

if ($conn->query($sql) === TRUE) {
	echo "New Account created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

Welcome <?php echo $name; ?><br>
Password is: <?php echo $userpassword; ?>

</body>
</html>
