function modal_onclick(id) {
	if (Number(id) < 10)
		var elem = document.getElementById("modal0" + id);
	else
		var elem = document.getElementById("modal" + id);
	elem.style.display = "block";
}

function hide_modal(id) {
	if (Number(id) < 10)
		var elem = document.getElementById("modal0" + id);
	else
		var elem = document.getElementById("modal" + id);
	elem.style.display = "none";
}

var modal01 = document.getElementById("modal01");
var modal02 = document.getElementById("modal02");
var modal03 = document.getElementById("modal03");

window.onclick = function(event) {
	if (event.target == modal01) {
		modal01.style.display = "none";
	} else if (event.target == modal02) {
		modal02.style.display = "none";
	} else if (event.target == modal03) {
		modal03.style.display = "none";
	}

}