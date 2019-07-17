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

var slideindex = 0;
var slideduration = 6000;
var directselect;
var autoslide = 1;

var imgArray = [
    'resources\\img\\menu-des-roulants-preview.jpg',
    'resources\\img\\test.png',
    'http://qnimate.com/wp-content/uploads/2014/03/images2.jpg'
];


//updating the slide number HTML display to current slide
document.getElementById("current-slide-number").innerHTML = "image " + (slideindex + 1) + " / " +
    imgArray.length;

function slideShow(way, onclick, directselect) {

    if (onclick == 1 || autoslide == 1) {
        console.log("Inside SlideShow");
        slideindex += way;
        var element = document.getElementById('images-slideshow');

        if (directselect > 0) {
            slideindex = directselect - 1;
        }
        if (slideindex == imgArray.length) {
            slideindex = 0;
        } else if (slideindex < 0) {
            slideindex = imgArray.length - 1;
        }
        console.log("slideindex = " + slideindex);

        //updating the slide number HTML display to current slide
        document.getElementById("current-slide-number").innerHTML = "image " + (slideindex + 1) + " / " +
            imgArray.length;

        element.className += "fadeOut";
        setTimeout(function() {
            element.src = imgArray[slideindex];
            setTimeout(function() {
                element.className = "";
            }, 300)
        }, 1000);
        if (onclick == 0 && autoslide == 1) {
            console.log("auto");
            setTimeout(slideShow, slideduration, 1, 0, 0);
        } else if (onclick == 1) {
            console.log("Onclick");
            autoslide = 0;
            setTimeout(function() {
                console.log("Relaunching Auto slide");
                autoslide = 1;
                slideShow(1, 0, 0)
            }, slideduration + 10000)
        }
    }


}
setTimeout(slideShow, slideduration, 1, 0, 0);