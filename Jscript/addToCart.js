var popupTimer;

function addToCart(itemId, itemName) {
	$.ajax({
		   url: "../SQLcalls/addToCart.php",
		   type: "GET",
		   data: {itemid: itemId},
		   dataType: "json",
		   success: function(items){
			   addNotification(itemName);
			   updateCartCounter(items);
		   }
		 });
}

function addNotification(message) {
	clearTimeout(popupTimer);
	var x = document.getElementById("notificationPopup");
	var y = message;
	x.innerHTML = "added "+y;
	x.style.transition = "transform .3s ease-out";
	x.style.transform = "translate(0, 0px)";
	popupTimer = setTimeout(function(){fadeout(x);}, 2000);

}
function fadeout(x) {
	x.style.transition = "transform 2.0s ease-out";
	x.style.transform = "translate(0, -40px)";
}
