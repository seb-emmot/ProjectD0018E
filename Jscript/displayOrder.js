/**
 * 
 */
function displayOrder(orderId){
	$.ajax({
		   url: "../SQLcalls/getOrderItems.php",
		   type: "GET",
		   data: {orderid: orderId},
		   dataType: "json",
		   success: function(orderItems){;
			   var container = document.getElementById(orderId);
			   var div = document.createElement("div");
			   div.setAttribute('class', "orderItems");
			   createAndAppend("cartView", div, "Product:");
			   createAndAppend("cartView", div, "Item-ID:");
			   createAndAppend("cartView", div, "quantity:");
			   createAndAppend("cartView", div, "Price/unit:");
			   for (index = 0; index < orderItems.length; ++index) {
				   createAndAppend("cartView", div, orderItems[index]);
				   
			   }
			   createPullUpBar(div);
			   
			   container.appendChild(div);
			   
		   }
	 });
}
function createAndAppend(c, div, text){
	var item = document.createElement("div");
	   item.setAttribute('class',c);
	   item.innerHTML = text;
	   div.appendChild(item);
}

function createPullUpBar(div){
	var item = document.createElement("div");
	   item.setAttribute('class',"pullUpItems");
	   item.innerHTML = "&#9650";
	   item.addEventListener("click", function() {
			div.parentNode.removeChild(div);
		}, false);
	   div.appendChild(item)
}