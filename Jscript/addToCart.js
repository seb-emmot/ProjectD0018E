function addToCart(itemId) {
	$.ajax({
		   url: "../SQLcalls/addToCart.php",
		   type: "GET",
		   data: {itemid: itemId},
		   success: function(){
					window.alert("added "+itemId);			   
		   }
		 });
}