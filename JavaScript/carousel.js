var btnLeft = document.querySelector(".btn-left");
var btnRight = document.querySelector(".btn-right");
var slider = document.querySelector("#slider");
var sliderSection = document.querySelectorAll(".slider-section");

btnLeft.addEventListener("click", (e) => moveToLeft());
btnRight.addEventListener("click", (e) => moveToRight());

setInterval(() => {
  moveToRight();
}, 7000);

var operacion = 0;
var counter = 0;
var widthImg = 100 / sliderSection.length;

function moveToRight() {
  if (counter >= sliderSection.length - 1) {
    counter = 0;
    operacion = 0;
    slider.style.transform = `translate(-${operacion}%)`;
    return;
  }
  counter++;
  operacion = operacion + widthImg;
  slider.style.transform = `translate(-${operacion}%)`;
  slider.style.transition = "all ease .6s";
}

function moveToLeft() {
  counter--;
  if (counter < 0) {
    counter = sliderSection.length - 1;
    operacion = widthImg * (sliderSection.length - 1);
    slider.style.transform = `translate(-${operacion}%)`;
    return;
  }
  operacion = operacion - widthImg;
  slider.style.transform = `translate(-${operacion}%)`;
  slider.style.transition = "all ease .6s";
}

//Vista mobile
var btnLeftMobile = document.querySelector(".btn-leftMobile");
var btnRightMobile = document.querySelector(".btn-rightMobile");
var slider1 = document.querySelector("#slider1");
var sliderSection1 = document.querySelectorAll(".slider-section1");

btnLeftMobile.addEventListener("click", (e) => moveToLeftMobile());
btnRightMobile.addEventListener("click", (e) => moveToRightMobile());

setInterval(() => {
  moveToRightMobile();
}, 7000);

var operacion1 = 0;
var counter1 = 0;
var widthImg1 = 100 / sliderSection1.length;

function moveToRightMobile() {
  if (counter1 >= sliderSection1.length - 1) {
    counter1 = 0;
    operacion1 = 0;
    slider1.style.transform = `translate(-${operacion1}%)`;
    return;
  }
  counter1++;
  operacion1 = operacion1 + widthImg1;
  slider1.style.transform = `translate(-${operacion1}%)`;
  slider1.style.transition = "all ease .6s";
}

function moveToLeftMobile() {
  counter1--;
  if (counter1 < 0) {
    counter1 = sliderSection1.length - 1;
    operacion1 = widthImg1 * (sliderSection1.length - 1);
    slider1.style.transform = `translate(-${operacion1}%)`;
    return;
  }
  operacion1 = operacion1 - widthImg1;
  slider1.style.transform = `translate(-${operacion1}%)`;
  slider1.style.transition = "all ease .6s";
}
