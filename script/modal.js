function connexion_onclick() {
    let elem = document.getElementById("modal01");
    elem.style.display = "block";
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

function take_a_pict_onclick() {
    document.getElementById("modal03").style.display = "block";
}

function hide_modal_take_a_pict() {
    document.getElementById("modal03").style.display = "none";
}

var modal01 = document.getElementById("modal01");
var modal03 = document.getElementById("modal03");
var modal02 = document.getElementById("modal02");


window.onclick = function(event) {
    if (event.target == modal01) {
        modal01.style.display = "none";
    } else if (event.target == modal03) {
        modal03.style.display = "none";
    } else if (event.target == modal02) {
        modal02.style.display = "none";
    }
}