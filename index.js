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