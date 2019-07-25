function connexion_onclick() {
    document.getElementById("modal01").style.display = "block";
}

function inscri_onclick() {
    document.getElementById("modal02").style.display = "block";
}

function hide_modal_connect() {
    document.getElementById("modal01").style.display = "none";
}

function hide_modal_inscri() {
    document.getElementById("modal02").style.display = "none";
}

var modal01 = document.getElementById("modal01");
var modal02 = document.getElementById("modal02");


window.onclick = function(event) {
    if (event.target == modal01) {
        modal01.style.display = "none";
    } else if (event.target == modal02) {
        modal02.style.display = "none";
    }
}