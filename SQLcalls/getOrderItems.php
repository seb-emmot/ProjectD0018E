<?php
include '../resources/connect.php';
$oID = $_GET["orderid"];
$sql = "SELECT * FROM order_items WHERE order_id = '$oID'";
$items = $conn->query($sql);
$orderItems = array();
while ($row = $items->fetch_assoc()){
	$sql_item_info = "SELECT name FROM PRODUCTS WHERE item_id =".$row["item_id"];
	$itemInfo = $conn->query($sql_item_info);
	$itemInfo = $itemInfo->fetch_assoc();
	array_push($orderItems, $itemInfo["name"], $row["item_id"], $row["quantity"], $row["price"] );
}
echo json_encode($orderItems);

?>