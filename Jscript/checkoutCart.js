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