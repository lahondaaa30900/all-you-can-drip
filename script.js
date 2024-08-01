// script.js
document.addEventListener('DOMContentLoaded', function() {
    let index = 0;
    const items = document.querySelectorAll('.carousel-item');
    const itemCount = items.length;
    const innerCarousel = document.querySelector('.carousel-inner');

    function showNextItem() {
        index = (index + 1) % itemCount;
        innerCarousel.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(showNextItem, 3000);
});
