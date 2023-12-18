const header = document.querySelector("header");

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky", this.window.scrollY > 0);
})
let menu = document.querySelector('#menu-icon');
let navmenu = document.querySelector('.navmenu');
/* response */
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navmenu.classList.toggle('open');
    
}

/* slide */
var slideIndex = 0;
showSlides();

function showSlides() {
 var i;
 var slides = document.getElementsByClassName("slide");
 for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
 }
 slideIndex++;
 if (slideIndex > slides.length) {slideIndex = 1}    
 slides[slideIndex-1].style.display = "block";  
 setTimeout(showSlides, 2000); // Change image every 2 seconds
}
