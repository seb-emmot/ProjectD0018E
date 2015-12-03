<?php
session_start();
$uID = $_SESSION["id"];
$totPrice = $_GET["totalPrice"];
include '../resources/connect.php';
$sql_lay_order = "INSERT INTO orders (`user_id`, `price`) VALUES ($uID, $totPrice)";
$conn->query($sql_lay_order);
$sql_get_id = "SELECT @@identity AS id";
$orderID = $conn->query($sql_get_id);
$orderID = $orderID->fetch_assoc();
$orderID = $orderID["id"];
$sql_get_items = "SELECT * FROM cart_items WHERE user_id = " . $uID;
$cart = $conn->query($sql_get_items);//get cart associated to checkout

while ($row = $cart->fetch_assoc()){
	$sql_lay_order = "INSERT INTO order_items (`order_id`, `item_id`, `quantity`) 
			VALUES ($orderID, ".$row["item_id"].", ".$row["quantity"].")";
	$conn->query($sql_lay_order);
	
	$sql_change_stock = "UPDATE PRODUCTS
		SET stock = stock - ".$row["quantity"]."
		WHERE item_id=".$row["item_id"];
	$conn->query($sql_change_stock);
}

$sql_delete_cart= "DELETE FROM cart_items WHERE user_id =". $uID;
$conn->query($sql_delete_cart);
$_SESSION["itemsInCart"] = 0;
echo json_encode(0);
?>