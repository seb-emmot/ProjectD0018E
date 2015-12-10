<?php 
 session_start();
 include '../resources/connect.php';
 if ($_SESSION["logged_in"]){
	 $sql_delete_cart= "DELETE FROM cart_items WHERE user_id =" . $_SESSION["id"];
	 $conn->query($sql_delete_cart);
	 $_SESSION["itemsInCart"] = 0;
 }
 else{
 	$_SESSION["shopping_cart"] = array();
 }
 echo json_encode(0);
?>