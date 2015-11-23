<?php
session_start();
include '../resources/connect.php';
$c_id = $_SESSION["c_id"];
$i_id = $_GET['itemid'];
$sql_delete_from_cart= "DELETE FROM cart_items WHERE cart_id = '$c_id' AND item_id ='$i_id'";
if($conn->query($sql_delete_from_cart)){
	echo "success!";
}
$sql= "SELECT * FROM cart_items WHERE cart_id = '$c_id'";
$items = $conn->query($sql);
if ($items->num_rows == 0){
	include 'delete_whole_cart.php';
	echo json_encode(true);
}
else {
	echo json_encode(false);
}
?>