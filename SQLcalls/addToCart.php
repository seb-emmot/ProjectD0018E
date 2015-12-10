<?php
session_start();
include '../resources/connect.php';
$i_id = $_GET['itemid'];
if ($_SESSION["logged_in"]){
	$u_id = $_SESSION["id"];
	$numToIncrement = 1;
	
	$_SESSION["itemsInCart"] = $_SESSION["itemsInCart"] + 1;
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
}
else {
	$continue = true;
	for ($i = 0;$i< sizeof($_SESSION["shopping_cart"]); $i++){
		if ($_SESSION["shopping_cart"][$i][0] == $i_id){
			$_SESSION["itemsInCart"] = $_SESSION["itemsInCart"] + 1;
			$_SESSION["shopping_cart"][$i][1] += 1;
			$continue = false;
		}
	}
	if($continue){
		$_SESSION["itemsInCart"] = $_SESSION["itemsInCart"] + 1;
		$_SESSION["shopping_cart"][] = array($i_id, 1);
	}
}

echo json_encode($_SESSION["itemsInCart"]);
?>