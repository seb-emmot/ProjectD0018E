<?php 
 session_start();
 include '../resources/connect.php';
 $sql_delete_cart= "DELETE FROM cart WHERE cart_id =" . $_SESSION["c_id"];
 $conn->query($sql_delete_cart);
?>