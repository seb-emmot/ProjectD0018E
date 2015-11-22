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
					<?php 
					include "../resources/connect.php";
					$itemID = $_GET["product"];
					$sql = "SELECT * FROM `products` WHERE item_id = ".$itemID;
					$item = $conn->query($sql);
					$item = $item->fetch_assoc();
					echo '
					<div class="productPage">
						<img alt="image" src="'.$item["category"].'/'.$itemID.'/img/default.png">
						<h3>'.$item["name"].'</h3>
						<p class="productDescr">';
					$inc = $item["category"].'/'.$itemID.'/descr.php';
					include "$inc";
					echo '
						</p>
					</div>';
					
					?>
			</div>
		</div>
		<div id="footer">
			footer
		</div>
	</div>
</body>
</html>