<?php
session_start();
include '../resources/connect.php';
$i_id = $_GET['itemid'];

$sql = "SELECT * FROM reviews WHERE item_id = '$i_id'";
$item = $conn->query($sql);
$item = $item->fetch_assoc();

$reviewArray = array('userID' => $item["user_id"], 'comment' => $item["comment"], 'rating' => $item["rating"]);
echo json_encode($reviewArray);