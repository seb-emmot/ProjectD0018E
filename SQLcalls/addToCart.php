<?php
session_start();
include '../resources/connect.php';
//$c_id = $_SESSION["c_id"];
$c_id = 2;
$i_id = $_GET['itemId'];
$sqlAddToCart = "INSERT INTO cart_items (`cart_id`, `item_id`, `quantity`) VALUES ($c_id, $i_id, '1')";

$conn->query($sqlAddToCart);
?>