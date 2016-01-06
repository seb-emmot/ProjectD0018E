<?php session_start();
if(isset($_SESSION["admin"])){
}
else {
	header("Location: adminLogin.php");
} ?>
<script src="../Jscript/admin/adminPage.js"></script>
<html>
<head>
	<script type="text/javascript" src="../jquery-1.11.3.min.js"></script>
	<LINK href="/ProjectD0018E/style/productSystem.css" rel="stylesheet" type="text/css">
	<LINK href="/ProjectD0018E/style/styleReset.css" rel="stylesheet" type="text/css">
	<LINK href="/ProjectD0018E/style/adminStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrapper">
		<div id="top" class="productBoxStyling">
			This is the adminpage, you are logged in as Admin: <?php echo $_SESSION["adminname"]?>
		</div>
		<div id="main">
			<div id="mainSidebar" class="productBoxStyling">
				<ul>
					<li id="adminAddProduct">Add Product</li>
					<li id="adminViewProducts">View Products</li>
					<li id="adminViewUsers">View Users</li>
					<li id="adminViewOrders">View Orders</li>
					
					<a href="../" style="color:black;hover:none;text-decoration:none"><li>Back to Homepage</li></a>
				</ul>
			</div>
			<div id="mainContent" class="productBoxStyling">
				<div id="adminAddProductPage" class="inActive">
					<form action="adminAddProduct.php" method="post" enctype="multipart/form-data">
					Product Name<br><input type="text" name="productName" required><br>
					Product Price<br><input type="text" name="productPrice" required><br>
					Product Category<br><input type="text" name="productCategory" required><br>
					Product Stock<br><input type="text" name="productStock" required><br>
					Product Description<br><textarea name="productDescription" rows="5" cols="30" required></textarea><br>
					Select image to upload: <br>
	    			<input type="file" name="fileToUpload" id="fileToUpload"><br>
					<input id="submit" type="submit" value="Submit" name ="submit">
					</form>
				</div>
				<div id="adminViewProductsPage" class="inActive">
					<div id="adminViewProductsPageTopBar" class="product">
						<ul>
							<li>ID</li>
							<li class="productExtra">Product Name</li>
							<li>Category</li>
							<li>Price</li>
							<li>Current Stock</li>
							<li>Average Rating</li>
							<li>Status</li>
						</ul>
						
					</div>
					<div id="adminViewProductsPageContent">
					</div>
				</div>
				<div id="adminViewUsersPage" class="inActive">
					<div i="adminViewUsersPageTopBar" class="product">
						<ul>
							<li>ID</li>
							<li>e-mail</li>
							<li>password</li>
							<li class="productExtra">registration date</li>
							<li>first name</li>
							<li>last name</li>
							<li>Address</li>
						</ul>
					</div>
					<div id="adminViewUsersPageContent">
					</div>		
				</div>
				<div id="adminViewOrdersPage" class="active">
					<div i="adminViewOrdersPageTopBar" class="product">
						<ul>
							<li>order id</li>
							<li>username</li>
							<li>price paid</li>
							<li>item</li>
							<li>date</li>
						</ul>
					</div>
					<div id="adminViewOrdersPageContent">
					</div>		
				</div>
				
			</div>
		</div>
	</div>
	<div id="foot" class="productBoxStyling">
		foot
	</div>
	<script type="text/javascript">
		setupAdmin();
	</script>	
</body>
</html>

