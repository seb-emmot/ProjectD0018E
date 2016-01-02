<?php
include 'resources/connect.php';
$allItems = [[]];
$item_id = $_GET["itemId"];
$sql_similar_orders = "SELECT order_id FROM order_items WHERE item_id = ". $item_id;
$similarOrders = $conn->query($sql_similar_orders);
while ($orderRow = $similarOrders->fetch_assoc()){
	$sql_get_suggestions = "SELECT item_id FROM order_items WHERE order_id = " . $orderRow["order_id"];
	$items = $conn->query($sql_get_suggestions);
	while ($itemRow = $items->fetch_assoc()){
		
		if(in_array_multi($allItems, $itemRow["item_id"])){
			$index = array_search_multi($allItems, $itemRow["item_id"]);
			$allItems[$index][1] = $allItems[$index][1] + 1;
		}
		else {
			$tuple = [$itemRow["item_id"], 1];
			array_push($allItems, $tuple);
		}
		
	}
}

function in_array_multi($array, $item){
	for($i=0; $i< sizeof($array); $i++){
		if($array[i][0] == $item){
			return true;
		}
	}
	return false;
}

function array_search_multi($array, $item){
	for($i=0; $i< sizeof($array); $i++){
		if($array[i][0] == $item){
			return i;
		}
	}
}
?>