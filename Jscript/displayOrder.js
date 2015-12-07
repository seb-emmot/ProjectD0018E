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
			   var link = document.getElementById(orderId+"items");
			   if(link.innerHTML === "+"){
				   var div = document.createElement("div");
				   div.setAttribute('class', "orderItems");
				   createAndAppend("cartView", div, "Product:");
				   createAndAppend("cartView", div, "Item-ID:");
				   createAndAppend("cartView", div, "quantity:");
				   createAndAppend("cartView", div, "Price/unit($):");
				   for (index = 0; index < orderItems.length; ++index) {
					   createAndAppend("cartView", div, orderItems[index]);
					   
				   }
				   createPullUpBar(div, link);
				   container.appendChild(div);
				   link.innerHTML = "";
			   }
			   
				
		   }
	 });
}
function createAndAppend(c, div, text){
	var item = document.createElement("div");
	   item.setAttribute('class',c);
	   item.innerHTML = text;
	   div.appendChild(item);
}

function createPullUpBar(div, link){
	var item = document.createElement("div");
	   item.setAttribute('class',"pullUpItems");
	   item.innerHTML = "&#9650";
	   $(item).css('cursor', 'pointer');
	   item.addEventListener("click", function() {
			div.parentNode.removeChild(div);
			link.innerHTML = "+";
		}, false);
	   div.appendChild(item)
	   
}