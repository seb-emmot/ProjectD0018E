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
				<?php 					
					function printProduct($itemID, $conn) {						
						$sql = "SELECT * FROM `products` WHERE item_id = ".$itemID;
						$item = $conn->query($sql);
						$item = $item->fetch_assoc();
						
						echo '	<div class="productBox">
									<a href="item.php?product='.$itemID.'"><img alt="Image" src="'.$item["category"].'/'.$itemID.'/img/default.png">
									</a>
									<div id="infoBox">
										<h1>'.$item["name"].'</h1>
										<h2>Price: $'.$item["price"].'</h2>
										<h2>Stock: '.$item["stock"].'</h2>
										<a href="#"><div class="productBoxBuyButton" onclick="addToCart('.$itemID.')">BUY</div></a>
									</div>
								</div>';
					}
					
					include '../resources/connect.php';
					
					$sql = "SELECT `item_id` FROM `PRODUCTS` WHERE category = 'testcat1'";
					$itemList = $conn->query($sql);
					while($itemListRow = $itemList->fetch_assoc()) {
							printProduct($itemListRow["item_id"], $conn);
					}
				?>
			</div>
		</div>
		<div id="footer">
			footer
		</div>
	</div>
</body>
</html>