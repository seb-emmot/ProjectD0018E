<?php
session_start();
include '../resources/connect.php';
$rating = $_POST["rating"];
$comment = $_POST["comment"];
$i_id = $_POST["product"];
$u_id = $_SESSION["id"];

$sql = "INSERT INTO `reviews`(`user_id`, `item_id`, `comment`, `rating`) VALUES ('$u_id', '$i_id', '$comment', '$rating')";
$conn->query($sql);

$sql = "SELECT rating FROM `reviews` WHERE item_id='$i_id'";

$itemRatings = $conn->query($sql);
$numberOfRatings = $itemRatings->num_rows;
$itemRatingSum = 0;
while($itemRatingsSingleRow = $itemRatings->fetch_array()) {
	$itemRatingSum = $itemRatingSum + $itemRatingsSingleRow[0];
}
$itemRatingSum = $itemRatingSum/$numberOfRatings;

$sql = "UPDATE `products` SET `rating`='$itemRatingSum' WHERE `item_id`='$i_id'";
$conn->query($sql);

header("Location: item.php?productID=".$_GET["productID"]);

?>

