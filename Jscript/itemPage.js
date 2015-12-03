function InitialSetup(itemID) {	
	$.ajax({
		   url: "../SQLcalls/getProductInfo.php",
		   type: "GET",
		   data: {itemid: itemID},
		   dataType: "json",
		   success: function(item){
			   Setup(item);
		   }
		 });
}

function Setup(item) {	// Gets info from the server regarding product name, price, category etc. and displays on the itempage.
	var currency = "$"
	var viewingDescription = true;
	
	var itemID = item.itemID;
	var category = item.category;
	var itemName = item.name;
	var itemPrice = item.price;
	var itemRating = item.rating;
	var itemStock = item.stock;
	
	var itemImgBox = document.getElementById("itemImgBox");
	var title = document.getElementById("itemTitle");
	var description = document.getElementById("itemTitle");
	var priceBox = document.getElementById("itemBuyBoxPrice");
	var itemRatingBox = document.getElementById("itemAvgRating");
	var itemStockBox = document.getElementById("itemBuyBoxStock");
	
	var itemReviews = document.getElementById("itemReviews");
	DisplayReviews(itemID, itemReviews);
	
	var imgID = "item:"+itemName
	itemImgBox.innerHTML = '<img id="'+imgID+'" src="'+category+'/'+itemName+'/img/default.png">';
	title.innerHTML = itemName;
	priceBox.innerHTML = currency+itemPrice;
	itemRatingBox.innerHTML = "average rating: "+itemRating+"/10";
	
	if(itemStock > 0) {
		itemStockBox.innerHTML = itemStock+" avaliable";
		itemStockBox.style.color = "green";
	}
	else {
		itemStockBox.style.color = "red";
		itemStockBox.innerHTML = "Out of stock";
	}
	
	
	document.getElementById("itemBuyBoxButton").addEventListener("click", function() {addToCart(itemID, itemName)});
	var descrButton = document.getElementById("itemDescriptionButton");
	var ratingButton = document.getElementById("itemRatingButton");	
	
	var submitReviewButton = document.getElementById("itemSubmitReviewButton");
	
	descrButton.addEventListener("click", function() {OpenDescription(descrButton, ratingButton)});
	ratingButton.addEventListener("click", function() {OpenRatings(descrButton, ratingButton)});
	itemImgBox.addEventListener("click", function() {CycleImg(imgID)});
	submitReviewButton.addEventListener("click", function() {SubmitReview()});
	
}

function CycleImg(imgID) {
	x = document.getElementById(imgID);
	x.style.transform = "rotate(720deg)";
}

function OpenDescription(descrButton, ratingButton) {
	descrButton.className = "itemActive";
	ratingButton.className = "itemDeactive";
	
	var description = document.getElementById("itemDescription");
	document.getElementById("itemReviewPage").style.display = "none";
	document.getElementById("itemDescriptionPage").style.display = "block";
}

function OpenRatings(descrButton, ratingButton) {
	descrButton.className = "itemDeactive";
	ratingButton.className = "itemActive";
	
	document.getElementById("itemDescriptionPage").style.display = "none";
	document.getElementById("itemReviewPage").style.display = "block";
}

function SubmitReview() {
	var x = document.getElementById("itemReviewForm").submit();
	
}

function DisplayReviews(itemID, displayElement) {
	$.ajax({
		   url: "../SQLcalls/getProductReviews.php",
		   type: "GET",
		   data: {itemid: itemID},
		   dataType: "json",
		   success: function(review){
			   displayElement.innerHTML = review.comment;
		   }
		 });
}


























