<html>
<body>
<?php
include 'connect.php';
$sql = "SELECT username FROM account WHERE UNIQUE_ID=1 LIMIT 1"
$account = mysql_query($sql);
echo $account;

?>
</body>
</html>
