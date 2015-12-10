function setupAdmin() {
	
	var adminAddProductButton = document.getElementById("adminAddProduct");
	adminAddProductButton.addEventListener("click", function() {setActive(document.getElementById("adminAddProductPage"))});
	
	var adminViewProductsButton = document.getElementById("adminViewProducts");	
	adminViewProductsButton.addEventListener("click", function() {setActive(document.getElementById("adminViewProductsPage"))});

	getProducts();
	
}

function setActive(pageToActivate) {
	var currentPage = document.getElementsByClassName("active");
	if(currentPage.length > 0) {
		currentPage[0].className = "inActive";
	}	
	pageToActivate.className = "active";
}

function getProducts() {
	$.ajax({
		   url: "SQL/getProducts.php",
		   type: "GET",
		   dataType: "json",
		   success: function(item){
			   displayProducts(item)
		   }
		 });
}

function displayProducts(allProducts) {
	var NUMBER_OF_ATTRIBUTES = 6;
	
	var displayPage = document.getElementById("adminViewProductsPageContent");
	var outputString = "";
	var counter = 0;
	while(counter<allProducts.length/NUMBER_OF_ATTRIBUTES) {
		outputString += '<div id=item#"'+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)]+'" class="product">';
		outputString += '<ul>';
		outputString += '<li>'+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';
		outputString += '<li>'+allProducts[1+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';
		outputString += '<li>'+allProducts[2+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';
		outputString += '<li>'+allProducts[3+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';
		outputString += '<li>'+allProducts[4+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';
		outputString += '<li>'+allProducts[5+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';
		
		outputString += '</ul></div>';
		counter++;
	}
	displayPage.innerHTML = outputString;	   
}

function displayUsers(allProducts) {
	
}