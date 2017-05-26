var slidesIndex = 1;
changeSlides(slidesIndex);

function plusSlides(x) {
  changeSlides(slidesIndex += x);
}

function changeSlides(x) {
  var y;
  var mySlides = document.getElementsByClassName("Slides");
  if(x > mySlides.length) {
    slidesIndex = 1;
  }else if(x < 1) {
    slidesIndex = mySlides.length;
  }
  for(i =0; i < mySlides.length; i++){
    mySlides[i].style.display = "none";
  }
  mySlides[slidesIndex - 1].style.display = "flex";
}
