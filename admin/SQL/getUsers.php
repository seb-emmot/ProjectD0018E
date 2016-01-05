<?php
session_start();
include '../../resources/connect.php';

$sql = "SELECT * FROM accounts WHERE 1";
$item = $conn->query($sql);
$usersArray = [];
while($user = $item->fetch_assoc()) {
	array_push($usersArray, $user["user_id"]);
	array_push($usersArray, $user["e_mail"]);
	array_push($usersArray, $user["password"]);
	array_push($usersArray, $user["reg_date"]);
	array_push($usersArray, $user["fname"]);
	array_push($usersArray, $user["lname"]);
	array_push($usersArray, $user["address"]);
}

echo json_encode($usersArray);