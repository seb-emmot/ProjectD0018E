<?php
session_start();
include '../resources/connect.php';
$u_id = $_SESSION["id"];
$i_id = $_GET['itemid'];
$sql_delete_from_cart= "DELETE FROM cart_items WHERE user_id = '$u_id' AND item_id ='$i_id'";
$conn->query($sql_delete_from_cart);
$_SESSION["itemsInCart"] = $_SESSION["itemsInCart"] - 1;
$sql= "SELECT * FROM cart_items WHERE user_id = '$u_id'";
$items = $conn->query($sql);
if ($items->num_rows == 0){
	echo json_encode(true);
}
else {
	echo json_encode(false);
}
?>