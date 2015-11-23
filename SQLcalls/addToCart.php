<?php
session_start();
include '../resources/connect.php';
$u_id = $_SESSION["id"];
$i_id = $_GET['itemid'];
$numToIncrement = 1;

$sql = "SELECT * FROM cart_items WHERE user_id = '$u_id' AND item_id ='$i_id'";
$item = $conn->query($sql);
if($item->num_rows == 1) {
	$item = $item->fetch_assoc();
	$qty = intval($item["quantity"]);
	$qty = ++$qty;
	$sql = "UPDATE cart_items SET quantity = '$qty' WHERE user_id ='$u_id' AND item_id ='$i_id'";
	$conn->query($sql);
}
else {
	$sql = "INSERT INTO cart_items (`user_id`, `item_id`, `quantity`) VALUES ($u_id, $i_id, '1')";
	$conn->query($sql);
}

?>