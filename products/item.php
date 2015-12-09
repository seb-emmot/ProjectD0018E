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
									<form id="itemReviewForm" action="submitReview.php" method="post">
									<input type="radio" name="rating" value="1">
									<input type="radio" name="rating" value="2">
									<input type="radio" name="rating" value="3">
									<input type="radio" name="rating" value="4">
									<input type="radio" name="rating" value="5"> <br>
									<textarea name="comment" rows="5" cols="30"></textarea>
									<input type="hidden" name="product" value="<?php echo $_GET["productID"];?>">
									<input type="submit" value="Submit">
									</form>
									<div id="itemSubmitReviewButton"></div>
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
					InitialSetup(<?php echo $_GET["productID"];?>);
					</script>					
				</div>
			</div>
		</div>
		<div id="footer">
			footer
		</div>
	</div>
</body>
</html>