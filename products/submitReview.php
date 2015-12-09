<?php
session_start();
include '../resources/connect.php';
$rating = $_POST["rating"];
$comment = $_POST["comment"];
$product = $_POST["product"];
$u_id = $_SESSION["id"];

echo $rating, $comment, $product, $u_id;
$sql = "INSERT INTO `reviews`(`user_id`, `item_id`, `comment`, `rating`) VALUES ('$u_id', '$product', '$comment', '$rating')";
$conn->query($sql);


