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
	var currency = "$";
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
	
	var itemReviewsBox = document.getElementById("itemReviews");
	DisplayReviews(itemID);
	
	var imgID = "item:"+itemName
	itemImgBox.innerHTML = '<img id="'+imgID+'" src="'+category+'/'+itemName+'/img/default.png">';
	title.innerHTML = itemName;
	priceBox.innerHTML = currency+itemPrice;
	itemRatingBox.innerHTML = "average rating: "+itemRating+"/5";
	
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
	
	OpenDescription(descrButton, ratingButton);
	FillDescription(category, itemName);
	
	descrButton.addEventListener("click", function() {OpenDescription(descrButton, ratingButton)});
	ratingButton.addEventListener("click", function() {OpenRatings(descrButton, ratingButton)});
	itemImgBox.addEventListener("click", function() {CycleImg(imgID)});
	
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

function FillDescription(category, itemName) {
	var xhr;
	if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); 		// all browsers except IE
	else xhr = new ActiveXObject("Microsoft.XMLHTTP"); 		// for IE
	 
	xhr.open('GET', category+"/"+itemName+"/"+"descr"+'.html', false);
	xhr.onreadystatechange = function () {
		if (xhr.readyState===4 && xhr.status===200) {
			var div = document.getElementById('itemDescriptionPage');
			div.innerHTML = xhr.responseText;
		}
	}
	xhr.send();
}

function OpenRatings(descrButton, ratingButton) {
	descrButton.className = "itemDeactive";
	ratingButton.className = "itemActive";
	
	document.getElementById("itemDescriptionPage").style.display = "none";
	document.getElementById("itemReviewPage").style.display = "block";
}

function DisplayReviews(itemID) {
	$.ajax({
		   url: "../SQLcalls/getProductReviews.php",
		   type: "GET",
		   data: {itemid: itemID},
		   dataType: "json",
		   success: function(AllReviews){
			   var reviewPage = document.getElementById("itemReviewPageReviews");
			   var outputString = "";
			   var counter = 0;
			   while(counter<AllReviews.length/3) {
				   outputString = outputString+"<h2>"+AllReviews[0+(3*counter)]+" : "+AllReviews[2+(3*counter)]+" / 5</h2><p>\""+AllReviews[1+(3*counter)]+"\"</p><hr>";
				   counter++;
			   }
			   reviewPage.innerHTML = outputString;	   
		   }
		 });
}

function submitReview(productId){
	var rating = $('input[name=rating]:checked').val();
	var comment = $("#comment").val();
	if(rating != null){
		$.ajax({
			   url: "submitReview.php",
			   type: "POST",
			   data: {productID: productId,
				   	  Rating: rating,
				   	  Comment: comment},
			   dataType: "json",
			   success: function(data){
				   console.log("success\n");
				   if(data.loggedIn){
					   if(data.notCommented){
						   DisplayReviews(productId);
					   }
					   else {
						   alert("You have already commented this product!");
					   }
				   }
				   else{
					   alert("You need to be logged in to leave reviews!");
				   }
				   
			   }
		});
	}
	else{
		alert("You need to rate the product before submitting.");
	}
}

























