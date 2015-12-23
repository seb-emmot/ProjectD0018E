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
	var NUMBER_OF_ATTRIBUTES = 7;
	
	var displayPage = document.getElementById("adminViewProductsPageContent");
	var outputString = "";
	var counter = 0;
	var numberOfProducts = allProducts.length/NUMBER_OF_ATTRIBUTES;
	
	while(counter<numberOfProducts) {
		outputString += '<div id="item#'+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)]+'" class="product">'; 	//div ID
		outputString += '<ul>';																					
		outputString += '<li>'+allProducts[0+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';											//Item ID
		outputString += '<li class="productExtra">'+allProducts[1+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Product Name
		outputString += '<li id="productCategory">'+allProducts[3+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';						//Category
		outputString += '<li id="productPrice" class="numberExtra">'+allProducts[2+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Price
		outputString += '<li id="productStock" class="numberExtra">'+allProducts[4+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';		//Current Stock
		outputString += '<li class="numberExtra">'+allProducts[5+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>';						//Avg. Rating
		outputString += '<li id="productActive" class="numberExtra">'+allProducts[6+(NUMBER_OF_ATTRIBUTES*counter)]+'</li>'		//If active or not
		
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

function editItem(itemElement) {	//triggered when clicking on an item in the "view products" page
	itemElement.style.backgroundColor = "lightgray";
	if(isEditing) {
		var editor = document.getElementById("editor");
		var parent = editor.parentNode.parentNode;
		
		if(parent == itemElement) { //did you click the same item again?
			//isEditing=false;
			console.log("same clicked");
		}
		else {
			parent.removeChild(editor);
			parent.style.backgroundColor = "white";
			createEditor(itemElement);
		}
	}	
	else {
		createEditor(itemElement);
	}
}

function createEditor(itemElement) { //creates the editorial fields.
	var itemEditor = document.createElement("ul");
	itemEditor.setAttribute("id", "editor");
	var ActualValue = itemElement.childNodes.item(0);
	
	var IdField = document.createElement("li");
	var submitButton = document.createElement("input");	
	submitButton.setAttribute("type", "submit");
	submitButton.addEventListener("click", function() {updateProduct(ActualValue.childNodes.item(0).innerHTML)});
	IdField.appendChild(submitButton);
	
	var NameField = document.createElement("li");
	var inputName = document.createElement("input");
	inputName.setAttribute("type", "text");
	inputName.setAttribute("id", "newProductName")
	inputName.setAttribute("value", ActualValue.childNodes.item(1).innerHTML);
	NameField.setAttribute("class", "productExtra");
	NameField.appendChild(inputName);
	
	var CategoryField = document.createElement("li");
	var inputCategory = document.createElement("input");
	inputCategory.setAttribute("type", "text");
	inputCategory.setAttribute("id", "newCategory")
	inputCategory.setAttribute("value", ActualValue.childNodes.item(2).innerHTML);
	CategoryField.appendChild(inputCategory);
	
	var PriceField = document.createElement("li");
	var inputPrice = document.createElement("input");
	inputPrice.setAttribute("type", "text");
	inputPrice.setAttribute("id", "newPrice")
	inputPrice.setAttribute("value", ActualValue.childNodes.item(3).innerHTML);
	PriceField.appendChild(inputPrice);
	
	var StockField = document.createElement("li");
	var inputStock = document.createElement("input");
	inputStock.setAttribute("type", "text");
	inputStock.setAttribute("id", "newStock")
	inputStock.setAttribute("value", ActualValue.childNodes.item(4).innerHTML);
	StockField.appendChild(inputStock);	
	
	var RatingField = document.createElement("li");
	RatingField.innerHTML = "N/A";
	
	var StatusField = document.createElement("li");
	var inputStatus = document.createElement("input");
	inputStatus.setAttribute("type", "text");
	inputStatus.setAttribute("id", "newActive")
	inputStatus.setAttribute("value", ActualValue.childNodes.item(6).innerHTML);
	StatusField.appendChild(inputStatus);	
	
	itemEditor.appendChild(IdField);	
	itemEditor.appendChild(NameField);
	itemEditor.appendChild(CategoryField);
	itemEditor.appendChild(PriceField);
	itemEditor.appendChild(StockField);
	itemEditor.appendChild(RatingField);
	itemEditor.appendChild(StatusField);
	
	var itemForm = document.createElement("form");
	itemForm.appendChild(itemEditor);
	
	itemElement.appendChild(itemForm);
	isEditing = true;	
	inputName.focus();
}

function updateProduct(productID) {
	var newProductName = $("#newProductName").val();
	var newCategory = $("#newCategory").val();
	var newPrice = $("#newPrice").val();
	var newStock = $("#newStock").val();
	var newActive = $("#newActive").val();
	alert(newProductName);
	$.ajax({
		   url: "SQL/updateProduct.php",
		   type: "POST",
		   data: {	productID: productID,
			   		newProductName: newProductName, 
			   		newCategory: newCategory,
			   		newPrice: newPrice,
			   		newStock: newStock,
			   		newActive: newActive},
		   dataType: "json",
		   success: function(){
			   alert("success");
		   }
	});
}


function displayUsers(allProducts) {
	
}