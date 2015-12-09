<div id="navigation">
	<ul id="nav-bar">
	<!--<li><a href="/ProjectD0018E/products/products.php"></a></li>
		<li><a href="/ProjectD0018E">2</a> </li>
		<li><a href="/ProjectD0018E">3</a> </li>
		<li><a href="/ProjectD0018E">4</a> </li>
		<li><a href="/ProjectD0018E">5</a> </li>
		<li><a href="/ProjectD0018E">6</a> </li> -->
	</ul>
</div>
<script>
	var x = document.getElementById("nav-bar");
	x.innerHTML = '<li><a href="/ProjectD0018E/products/products.php?category=testcat1">testcat1</a></li>'+
		'<li><a href="/ProjectD0018E/products/products.php?category=testcat2">testcat2</a> </li>'+
		'<li><a href="/ProjectD0018E">3</a> </li>'+
		'<li><a href="/ProjectD0018E">4</a> </li>'+
		'<li><a href="/ProjectD0018E">5</a> </li>'+
		'<li><a href="/ProjectD0018E">6</a> </li>';
</script>