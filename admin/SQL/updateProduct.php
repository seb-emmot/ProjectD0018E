<?php
session_start();
include '../../resources/connect.php';

$productID = $_POST["productID"];
$newProductName = $_POST["newProductName"];
$newCategory = $_POST["newCategory"];
$newPrice = $_POST["newPrice"];
$newStock = $_POST["newStock"];
$newActive = $_POST["newActive"];

$sql = "UPDATE `products` SET `name`='$newProductName',`price`='$newPrice',`category`='$newCategory',`stock`='$newStock',`active`='$newActive' WHERE `item_id`='$productID'";

$conn->query($sql);

echo json_encode($productID);

?>

