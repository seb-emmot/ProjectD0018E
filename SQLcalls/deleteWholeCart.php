<?php 
 session_start();
 include '../resources/connect.php';
 $sql_delete_cart= "DELETE FROM cart_items WHERE user_id =" . $_SESSION["id"];
 $conn->query($sql_delete_cart);
 $_SESSION["itemsInCart"] = 0;
?>