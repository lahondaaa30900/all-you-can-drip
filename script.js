// script.js
document.addEventListener('DOMContentLoaded', function() {
    let index = 0;
    const items = document.querySelectorAll('.carousel-item');
    const itemCount = items.length;

    function showNextItem() {
        items[index].style.transform = 'translateX(-100%)';
        index = (index + 1) % itemCount;
        items[index].style.transform = 'translateX(0)';
    }

    setInterval(showNextItem, 3000);
});
