<?php
session_start();
include '../resources/connect.php';
$i_id = $_GET['itemid'];
if ($_SESSION["logged_in"]){
	$u_id = $_SESSION["id"];
	$sql_quantity= "SELECT quantity FROM cart_items WHERE user_id = '$u_id' AND item_id ='$i_id'";
	$quantity =$conn->query($sql_quantity);
	$quantity = $quantity->fetch_assoc();
	$_SESSION["itemsInCart"] = $_SESSION["itemsInCart"] - $quantity["quantity"];
	$sql_delete_from_cart= "DELETE FROM cart_items WHERE user_id = '$u_id' AND item_id ='$i_id'";
	$conn->query($sql_delete_from_cart);
	//$sql= "SELECT * FROM cart_items WHERE user_id = '$u_id'";
	//$items = $conn->query($sql);
}
else{
	for ($i = 0;$i< sizeof($_SESSION["shopping_cart"]); $i++){
		if ($_SESSION["shopping_cart"][$i][0] == $i_id){
			$_SESSION["itemsInCart"] = $_SESSION["itemsInCart"] - $_SESSION["shopping_cart"][$i][1];
			unset($_SESSION["shopping_cart"][$i]);
		}
	}
}

if ($_SESSION["itemsInCart"] == 0){
	echo json_encode(array(true, $_SESSION["itemsInCart"]));
}
else {
	echo json_encode(array(false, $_SESSION["itemsInCart"]));
}
?>