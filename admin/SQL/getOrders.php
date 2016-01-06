<?php
session_start();
include '../../resources/connect.php';

$sql = "SELECT * FROM orders WHERE 1";
$Allorders = $conn->query($sql);

$orderArray = [];

while($order = $Allorders->fetch_assoc()) {
	$sql = "SELECT * FROM order_items WHERE order_id=".$order["order_id"];
	$AllOrder_items = $conn->query($sql);
	array_push($orderArray, $order["order_id"]);
	$sql = "SELECT `e_mail` FROM `accounts` WHERE user_id=".$order["user_id"];
	$user = $conn->query($sql)->fetch_assoc();
	array_push($orderArray, $user["e_mail"]);
	array_push($orderArray, $order["price"]);
	
	while($order_item = $AllOrder_items->fetch_assoc()) {
		$sql = "SELECT `name` FROM `products` WHERE item_id=".$order_item["item_id"];
		$itemName = $conn->query($sql)->fetch_assoc();
		array_push($orderArray, $itemName["name"]);
		array_push($orderArray, $order_item["quantity"]);
		array_push($orderArray, $order_item["price"]);
	}
	array_push($orderArray, "null");	
	
}

echo json_encode($orderArray);