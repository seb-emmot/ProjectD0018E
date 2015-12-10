<?php session_start(); 
$productID = $_GET["productID"];
?>
<html>
<?php include '../HTMLelements/head.php';?>
<body>
	<div id="pagewrapper">
		<?php include '../HTMLelements/header.php'?>
		<div id="wrapper">
			<?php include '../HTMLelements/header_meny.php';?>	
			<div id="main">
				<div id="itemPage">
					<script src="../Jscript/addToCart.js"></script>
					<script src="../Jscript/itemPage.js"></script>
					<script src="../Jscript/updateCartCounter.js"></script>
					<div id="itemSideBar">
						<div id="itemImgBox" ></div>
						<div id="itemReviewBox">
							<p id="itemAvgRating" class="productBoxStyling">Average Rating</p>
							<div id="itemReviews" class="productBoxStyling">
							
							</div>
						</div>
					</div>			
					<div id="itemStatBox">
						<div id="itemContentBox">
							<h1 id="itemTitle" class="productBoxStyling">Title</h1>
							<div id="itemContentMeny">
								<ul id="itemList">
									<li id="itemDescriptionButton" class="itemActive">Description</li>
									<li id="itemRatingButton" class="itemDeactive">Ratings</li>									
								</ul>
							</div>
							<div id="itemContent" class="productBoxStyling">
								<div id="itemDescriptionPage">
								</div>
								<div id="itemReviewPage">
									<div id="itemReviewPageReviews">
									</div>
									<br>
									<form id="itemReviewForm" method="GET">
										<input type="radio" name="rating" value="1">
										<input type="radio" name="rating" value="2">
										<input type="radio" name="rating" value="3">
										<input type="radio" name="rating" value="4">
										<input type="radio" name="rating" value="5"> <br>
										<textarea id="comment" name="comment" rows="5" cols="30"></textarea>
										<input type="hidden" name="productId" value="<?php echo $productID;?>">
										<input id="submit" type="button" value="Submit" onclick="submitReview(<?php echo $productID;?>)">
									</form>
								</div>
							</div>
						</div>
						<div id="itemBuyBox" class="productBoxStyling">
							<h1 id="itemBuyBoxPrice"></h1>
							<div id="itemBuyBoxButton">BUY</div>
							<div id="itemBuyBoxStock"></div>
						</div>
					</div>
					
					<script type="text/javascript">
					InitialSetup(<?php echo $productID;?>);
					</script>					
				</div>
			</div>
		</div>
		<?php include '../HTMLelements/footer.php';?>
	</div>
</body>
</html>