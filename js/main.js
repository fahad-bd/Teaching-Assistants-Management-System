//----------------------- Automatic Slideshow -------------------------//
var my___Index = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  my___Index++;
  if (my___Index > x.length) {my___Index = 1}    
  x[my___Index-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
//--------------------- End Automatic Slideshow ----------------------//

