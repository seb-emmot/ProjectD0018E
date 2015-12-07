<?php
session_start();
include '../resources/connect.php';
$i_id = $_GET['itemid'];

$sql = "SELECT * FROM reviews WHERE item_id = '$i_id'";
$item = $conn->query($sql);
$reviewArray = [];
while($review = $item->fetch_assoc()) {
	$user_id = $review["user_id"];
	$sql = "SELECT e_mail FROM accounts WHERE user_id ='$user_id'";
	$username = $conn->query($sql);
	$username = $username->fetch_assoc();
	array_push($reviewArray, $username["e_mail"]);
	array_push($reviewArray, $review["comment"]);
	array_push($reviewArray, round($review["rating"], 1));
}

//$reviewArray = array('userID' => $item["user_id"], 'comment' => $item["comment"], 'rating' => $item["rating"]);
echo json_encode($reviewArray);