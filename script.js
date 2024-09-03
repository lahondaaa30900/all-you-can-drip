document.addEventListener('DOMContentLoaded', () => {
    const brands = document.querySelectorAll('.brand-item');
    const intervalTime = 10000; // 10 secondes
    let currentIndex = 0;

    // Initialisation : afficher les premières marques
    showBrands(currentIndex);

    // Changer les marques toutes les 10 secondes
    setInterval(() => {
        fadeOutBrands(currentIndex, () => {
            currentIndex = (currentIndex + 4) % brands.length; // Passer à l'ensemble suivant
            fadeInBrands(currentIndex);
        });
    }, intervalTime);

    function showBrands(index) {
        for (let i = 0; i < brands.length; i++) {
            brands[i].style.display = (i >= index && i < index + 4) ? 'block' : 'none';
        }
    }

    function fadeOutBrands(index, callback) {
        let opacity = 1;
        const fadeOutInterval = setInterval(() => {
            opacity -= 0.05;
            for (let i = index; i < index + 4 && i < brands.length; i++) {
                brands[i].style.opacity = opacity;
            }
            if (opacity <= 0) {
                clearInterval(fadeOutInterval);
                showBrands(-1); // Cacher toutes les marques
                callback();
            }
        }, 50);
    }

    function fadeInBrands(index) {
        showBrands(index);
        let opacity = 0;
        const fadeInInterval = setInterval(() => {
            opacity += 0.05;
            for (let i = index; i < index + 4 && i < brands.length; i++) {
                brands[i].style.opacity = opacity;
            }
            if (opacity >= 1) {
                clearInterval(fadeInInterval);
            }
        }, 50);
    }
});
