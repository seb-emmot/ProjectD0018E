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
				<div class="productBox">
					<a href="item.php?product=1"><img alt="Image" src="testcat1/1/img/default.png"></a>
				</div>
				<?php 					
					function printProduct($itemID, $conn) {						
						$sql = "SELECT * FROM `products` WHERE item_id = ".$itemID;
						$item = $conn->query($sql);
						$item = $item->fetch_assoc();
						
						echo '	<div class="productBox">
								<a href="item.php?product='.$itemID.'"><img alt="Image" src="'.$item["category"].'/'.$itemID.'/img/default.png"></a>
								</div>';
					}
					
					include '../resources/connect.php';
					
					for($i=1; $i<6; $i++) {
						printProduct($i, $conn);
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