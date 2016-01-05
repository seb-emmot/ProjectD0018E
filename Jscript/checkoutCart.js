/**
 * 
 */
function checkoutCart(totPrice){
	$.ajax({
		   url: "../SQLcalls/checkoutCart.php",
		   type: "GET",
		   data: {totalPrice: totPrice},
		   dataType: "json",
		   success: function(items){
			   updateCartCounter(items);
			   orderConfirmed();
		   }
	});
}

function orderConfirmed() {
	document.getElementById("checkoutInfo").innerHTML = "Congratulations, you have successfully laid an order on the following items!<br>" +
			"If something is wrong, please contact us at WeDontGive@Fuck.com";
	var element = document.getElementById("cartCheckout");
	element.parentNode.removeChild(element);
}

function outOfStock(){
	var div = document.getElementById("checkoutInfo");
	div.innerHTML += "<br>Notice that you have some products in your order that are out of stock.<br>" +
			"Theese will have a delayed shipping time.<br>"
}