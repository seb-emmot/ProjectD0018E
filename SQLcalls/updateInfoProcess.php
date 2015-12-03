<?php
session_start();
include '../resources/connect.php';
$changed_info = $_POST["changed"];
$changed_column = $_POST["var"];
$uID = $_SESSION["id"];
$sql_update_info = "UPDATE ACCOUNTS
SET ".$changed_column."='$changed_info' 
WHERE user_id='$uID'";
if($conn->query($sql_update_info)){
header("Location: ../user/profile.php");
die();
}
?>