<?php session_start(); 

?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
		<?php include '../HTMLelements/header.php'?>
		<div id="wrapper">
			<?php include '../HTMLelements/header_meny.php';?>		
			<div id="main">
				<script src="../Jscript/addToCart.js"></script>
				<script src="../Jscript/updateCartCounter.js"></script>
				<?php 					
					function printProduct($itemID, $conn) {						
						$sql = "SELECT * FROM `products` WHERE item_id = ".$itemID;
						$item = $conn->query($sql);
						$item = $item->fetch_assoc();
						$itemName = $item["name"];
						
						
						echo '	<div id="product#'.$itemName.'" class="productBox">
									<a href="item.php?product='.$itemID.'"><img alt="Image" src="'.$item["category"].'/'.$itemID.'/img/default.png">
									</a>
									<div id="infoBox">
										<h1>'.$item["name"].'</h1>
										<h2>Price: $'.$item["price"].'</h2>
										<h2>Stock: '.$item["stock"].'</h2>
										<a id="'.$itemID.'" href="#none"><div class="productBoxBuyButton" onclick="';
						echo 'addToCart('.$itemID.',\''.$itemName.'\')';
						echo ' ">BUY</div></a>
									</div>
								</div>';
					}
					
					include '../resources/connect.php';
					
					$sql = "SELECT `item_id` FROM `PRODUCTS` WHERE category = 'testcat1'";
					$itemList = $conn->query($sql);
					while($itemListRow = $itemList->fetch_assoc()) { //Loops through all entries in Table and prints them
							printProduct($itemListRow["item_id"], $conn);
					}
				?>
			</div>
		</div>
		<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>