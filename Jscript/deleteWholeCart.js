/**
 * 
 */
function deleteWholeCart(){
		$.ajax({
			   url: "../SQLcalls/deleteWholeCart.php",
			   dataType: "json",
			   success: function(items){
				 document.getElementById("main").innerHTML = "Shoppingcart deleted!";
				 updateCartCounter(items);
			  }
		});
}