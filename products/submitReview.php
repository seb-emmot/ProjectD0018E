<?php
session_start();
include '../resources/connect.php';
if ($_SESSION["logged_in"]){
	$rating = $_POST["Rating"];
	$comment = $_POST["Comment"];
	$i_id = $_POST["productID"];
	$u_id = $_SESSION["id"];
	$sql = "INSERT INTO `reviews`(`user_id`, `item_id`, `comment`, `rating`) VALUES ('$u_id', '$i_id', '$comment', '$rating')";
	
	if($conn->query($sql)){
		$data = array('loggedIn' => true, 'notCommented' => true);
	}
	else {
		$data = array('loggedIn' => true, 'notCommented' => false);
	}
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
}
else {
	$data = array('loggedIn' => false, 'notCommented' => true);
}
echo json_encode($data);

?>

