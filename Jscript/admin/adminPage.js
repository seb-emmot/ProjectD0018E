var isEditing = false;

function setupAdmin() {
	
	var adminAddProductButton = document.getElementById("adminAddProduct");
	adminAddProductButton.addEventListener("click", function() {setActive(document.getElementById("adminAddProductPage"))});
	
	var adminViewProductsButton = document.getElementById("adminViewProducts");	
	adminViewProductsButton.addEventListener("click", function() {setActive(document.getElementById("adminViewProductsPage"))});
	
	var adminViewUsersButton = document.getElementById("adminViewUsers");	
	adminViewUsersButton.addEventListener("click", function() {setActive(document.getElementById("adminViewUsersPage"))});
	
	var adminViewOrdersButton = document.getElementById("adminViewOrders");	
	adminViewOrdersButton.addEventListener("click", function() {setActive(document.getElementById("adminViewOrdersPage"))});

	getProducts();
	getUsers();
	getOrders();
	
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

function getUsers() {
	$.ajax({
		   url: "SQL/getUsers.php",
		   type: "GET",
		   dataType: "json",
		   success: function(user){
			   displayUsers(user);		   
		   }
		 });
}

function displayUsers(allUsers) {
	console.log("user");
	var displayPage = document.getElementById("adminViewUsersPageContent");
	var NUMBER_OF_ATTRIBUTES = 7;
	
	var counter = 0;
	var numberOfUsers = allUsers.length/NUMBER_OF_ATTRIBUTES;
	
	while(counter<numberOfUsers) {
		var userDiv = document.createElement("div");
		userDiv.setAttribute("id", "user#"+allUsers[0+NUMBER_OF_ATTRIBUTES*counter]);
				
		var list = document.createElement("ul");
		list.setAttribute("class", "product")
		
		var id = document.createElement("li");
		id.innerHTML = allUsers[0+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(id);
		
		var e_mail = document.createElement("li");
		e_mail.innerHTML = allUsers[1+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(e_mail);
		
		var password = document.createElement("li");
		password.innerHTML = allUsers[2+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(password);
		
		var reg_date = document.createElement("li");
		reg_date.setAttribute("class", "productExtra");
		reg_date.innerHTML = allUsers[3+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(reg_date);
		
		var fname = document.createElement("li");
		fname.innerHTML = allUsers[4+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(fname);
		
		var lname = document.createElement("li");
		lname.innerHTML = allUsers[5+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(lname);
		
		var address = document.createElement("li");
		address.innerHTML = allUsers[6+NUMBER_OF_ATTRIBUTES*counter];
		list.appendChild(address);
		
		userDiv.appendChild(list);		
		displayPage.appendChild(userDiv);
		counter++;
	}	
}

function getOrders() {
	$.ajax({
		   url: "SQL/getOrders.php",
		   type: "GET",
		   dataType: "json",
		   success: function(allOrders){
			   displayOrders(allOrders);		   
		   }
		 });
}

function displayOrders(allOrders) {
	console.log("order");
	var displayPage = document.getElementById("adminViewOrdersPageContent");
	var NUMBER_OF_ATTRIBUTES = 3;
	
	var pointer = 0;
	var numberOfEntries = allOrders.length;
	
	while(pointer<numberOfEntries) {
		var userDiv = document.createElement("div");
		userDiv.setAttribute("id", "order#"+allOrders[pointer]);
				
		var list = document.createElement("ul");
		list.setAttribute("class", "product")
		
		var id = document.createElement("li");
		id.innerHTML = allOrders[pointer];
		list.appendChild(id);
		
		var user_id = document.createElement("li");
		user_id.innerHTML = allOrders[pointer+1];
		list.appendChild(user_id);
		
		var price = document.createElement("li");
		price.innerHTML = "$ "+allOrders[pointer+2];
		list.appendChild(price);
		
		var items = document.createElement("li");
		
		while(allOrders[pointer] != "null") {
			var item = document.createElement("p");
			item.innerHTML = allOrders[pointer+3];	
			items.appendChild(item);
			pointer = pointer+3;
			
		}
		list.appendChild(items);
				
		userDiv.appendChild(list);		
		displayPage.appendChild(userDiv);
		pointer++;
	}	
}

function editItem(itemElement) {	//triggered when clicking on an item in the "view products" page
	if(isEditing) {
		var editor = document.getElementById("editor");
		var parent = editor.parentNode;
		
		if(parent == itemElement) { //did you click the same item again? **Broken atm.
			isEditing=false;
			editor.parentNode.parentNode.style.backgroundColor = "#F8F8F8";
			parent.removeChild(editor);
			console.log("same clicked");
		}
		else {
			editor.parentNode.parentNode.style.backgroundColor = "#F8F8F8";
			parent.removeChild(editor);
			createEditor(itemElement);
			itemElement.style.backgroundColor = "lightgray";
		}
	}	
	else {
		itemElement.style.backgroundColor = "lightgray";
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
