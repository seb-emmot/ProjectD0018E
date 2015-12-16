var isEditing = false;

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
	var numberOfProducts = allProducts.length/NUMBER_OF_ATTRIBUTES;
	
	while(counter<numberOfProducts) {
		outputString += '<div id="item#'+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)]+'" class="product">'; 	//div ID
		outputString += '<ul>';																					
		outputString += '<li>'+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';							//Item ID
		outputString += '<li class="productExtra">'+allProducts[1+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Product Name
		outputString += '<li>'+allProducts[3+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';							//Category
		outputString += '<li class="numberExtra">'+allProducts[2+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Price
		outputString += '<li class="numberExtra">'+allProducts[4+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Current Stock
		outputString += '<li class="numberExtra">'+allProducts[5+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Avg. Rating
		
		outputString += '</ul></div>';
		counter++;
	}
	displayPage.innerHTML = outputString;	
	
	counter = 0;
	while(counter<numberOfProducts) { //Attaches evenlistener to every row on thee "view products" page
		var itemDivID = "item#"+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)];
		console.log(itemDivID);
		
		document.getElementById(itemDivID).addEventListener("click", function() {editItem(this)});
		counter++;
	}
}

function editItem(itemElement) {	
	if(isEditing) {
		var editor = document.getElementById("editor");
		var parent = editor.parentNode;
		parent.removeChild(editor);
		
		if(parent == itemElement) {
			isEditing=false;
		}
		else {
			createEditor(itemElement);
		}
	}
	
	else {
		createEditor(itemElement);
	}
}

function createEditor(itemElement) {
	var itemEditor = document.createElement("ul");
	itemEditor.setAttribute("id", "editor");

	var inputName = document.createElement("input");
	var inputCategory = document.createElement("input");
	var inputPrice = document.createElement("input");
	var inputStock = document.createElement("input");
	itemEditor.appendChild(inputName);
	itemEditor.appendChild(inputCategory);
	itemEditor.appendChild(inputPrice);
	itemEditor.appendChild(inputStock);
	
	itemElement.appendChild(itemEditor);
	isEditing = true;
}

function displayUsers(allProducts) {
	
}