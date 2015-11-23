function addToCart(itemId) {
	$.ajax({
		   url: "../SQLcalls/addToCart.php",
		   type: "GET",
		   data: {itemid: itemId},
		   success: function(){
			   productAdded();
		   }
		 });
}

function productAdded() {
	var x = document.getElementById("notificationPopup");
	if(x.style.opacity == "1") {
	}
	else {
		x.style.transition = "none";
		x.style.opacity = "1";
		setTimeout(function(){fadeout(x);}, 2000);
	}
}
function fadeout(x) {
	x.style.transition = "opacity 1.5s ease-out";
	x.style.opacity = "0";
}