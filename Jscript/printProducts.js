/**
 * 
 */
function printProducts(name, rating, itemID){
	console.log("done!");
	var div = document.createElement("div");
	div.setAttribute('class', "ratedProduct");
	$(div).css('cursor', 'pointer');
	   div.addEventListener("click", function() {
		   window.location.replace("../products/item.php?productID="+itemID);
		}, false);
	createAndAppend("productNameProfile", div, name);
	createAndAppend("productRatingProfile", div, rating + " Stars!");
	div.appendChild(document.createElement("br"));
	var rankedDiv = document.getElementById("rankedProducts");
	rankedDiv.appendChild(div);
	
	
}


function createAndAppend(c, div, text){
	var item = document.createElement("div");
	   item.setAttribute('class',c);
	   item.innerHTML = text;
	   div.appendChild(item);
}