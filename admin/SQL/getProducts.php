<?php
session_start();
include '../../resources/connect.php';

$sql = "SELECT * FROM products WHERE 1";
$item = $conn->query($sql);
$productArray = [];
while($product = $item->fetch_assoc()) {
	array_push($productArray, $product["item_id"]);
	array_push($productArray, $product["name"]);
	array_push($productArray, $product["price"]);
	array_push($productArray, $product["category"]);
	array_push($productArray, $product["stock"]);
	array_push($productArray, round($product["rating"], 1));
	array_push($productArray, $product["active"]);
}

echo json_encode($productArray);