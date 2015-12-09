 /**
 * 
 */
function deleteFromCart(itemId){
		$.ajax({
			   url: "../SQLcalls/deleteFromCart.php",
			   type: "GET",
			   data: {itemid: itemId},
			   dataType: "json",
			   success: function(data){
				    updateCartCounter(data[1]);
					if(data[0] == true){
						document.getElementById("main").innerHTML = "Shoppingcart deleted!";
					}
					else{
						var element = document.getElementById("div"+itemId);
						element.parentNode.removeChild(element);
					}
					   
				   
			   }
		 });
}