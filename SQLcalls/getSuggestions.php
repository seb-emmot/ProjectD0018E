<?php
include '../resources/connect.php';
$allItems = [];
$selectedItems = [];
$item_id = $_GET["itemID"];
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
			if ($itemRow["item_id"] != $item_id){
				$tuple = [$itemRow["item_id"], 1];
				array_push($allItems, $tuple);
			}
		}	
	}
	

}

usort($allItems, function($a, $b) {
	return $a[1] - $b[1];
});
$sql_item_info = "SELECT category, name, item_id FROM products WHERE item_id =  ";
for($i=0; $i < sizeof($allItems) && $i < 3; $i++){
	if ($i != 0){
		$sql_item_info .= "OR item_id = ";
	}
	$sql_item_info .= $allItems[$i][0] . " ";
}
$sql_item_info .= ";";
if(sizeof($allItems)>0){
	$items = $conn->query($sql_item_info);
	while ($row = $items->fetch_assoc()){
		array_push($selectedItems, array($row["item_id"], $row["name"], $row["category"]));
	}
}

echo json_encode($selectedItems);


function in_array_multi($array, $item){
	if (sizeof($array == 0)){
		return false;
	}
	for($i=0; $i< sizeof($array); $i++){
		if($array[$i][0] == $item){
			return true;
		}
	}
	return false;
}

function array_search_multi($array, $item){
	for($i=0; $i< sizeof($array); $i++){
		if($array[$i][0] == $item){
			return $i;
		}
	}
}
?>