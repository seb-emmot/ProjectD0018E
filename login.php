<?php 
session_start();
?>
<html>
<body>

<form action="loginprocess.php" method="post">
Enter your account information to login:<br>
Name: <input type="text" name="name"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>

Don't have an account? <a href="Registration.php">Register Here</a>
</body>
</html>
