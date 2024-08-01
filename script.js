// script.js
let slideIndex = 0;

function showSlides() {
    let slides = document.querySelectorAll(".carousel-slide");
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].classList.add("active");
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}

function plusSlides(n) {
    slideIndex += n;
    let slides = document.querySelectorAll(".carousel-slide");
    if (slideIndex > slides.length) {slideIndex = 1}
    if (slideIndex < 1) {slideIndex = slides.length}
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    slides[slideIndex-1].classList.add("active");
}

document.addEventListener('DOMContentLoaded', (event) => {
    showSlides();
});
