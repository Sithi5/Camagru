"use strict";

var idx = 1;

function Hide_button() {
    if (idx == 1) {
        console.log("Hidding button");
        document.getElementById("button-container").style.display = "none";
        idx = 2;
    } else {
        console.log("Showing button");
        document.getElementById("button-container").style.display = "block";
        idx = 1;
    }
}

var slide = 1;

function Change_Slide(way) {
    var elem;

    console.log("Changing Slide of Slideshow");
    slide += way;
    elem = document.getElementById("images-slideshow")
    console.log(elem);

    if (slide > 2) {
        slide = 1;
    } else if (slide < 1) {
        slide = 2;
    }
    if (slide == 1) {
        elem.src = "resources\\img\\menu-des-roulants-preview.jpg";
    } else if (slide == 2) {
        elem.src = "resources\\img\\test.png";
    }
}