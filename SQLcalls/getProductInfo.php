<?php
session_start();
include '../resources/connect.php';
$i_id = $_GET['itemid'];

$sql = "SELECT * FROM products WHERE item_id = '$i_id'";
$item = $conn->query($sql);
$item = $item->fetch_assoc();

$itemArray = array('itemID' => $item["item_id"], 'name' => $item["name"], 'category' => $item["category"] , 'price' => $item["price"], 'stock' => $item["stock"], 'rating' => round($item["rating"], 1));
echo json_encode($itemArray);