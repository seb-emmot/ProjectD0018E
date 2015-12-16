var logo = document.getElementById("logo-container");
logo.addEventListener("click", function() {gotoHome()});

function gotoHome() {
	window.location.replace("../index.php");
}