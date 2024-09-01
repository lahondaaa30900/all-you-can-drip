document.addEventListener('DOMContentLoaded', () => {
    const brands = [
        {name: "Nike", image: "./photos/nike.png", link: "produits_nike.html"},
        {name: "Adidas", image: "./photos/adidas.png", link: "produits_adidas.html"},
        {name: "Puma", image: "./photos/puma.png", link: "produits_puma.html"},
        {name: "Palm Angels", image: "./photos/palm-angels.png", link: "produits_palm_angels.html"},
        {name: "Louis Vuitton", image: "./photos/louis-vuitton.png", link: "produits_louis_vuitton.html"},
        {name: "Christian Dior", image: "./photos/christian-dior.png", link: "produits_christian_dior.html"},
        {name: "Air Jordan", image: "./photos/air-jordan.png", link: "produits_air_jordan.html"},
        {name: "Celine", image: "./photos/celine.png", link: "produits_celine.html"},
        {name: "Burberry", image: "./photos/burberry.png", link: "produits_burberry.html"},
        {name: "Calvin Klein", image: "./photos/calvin-klein.png", link: "produits_calvin_klein.html"},
        {name: "New Balance", image: "./photos/new-balance.png", link: "produits_new_balance.html"},
        {name: "Amiri", image: "./photos/amiri.png", link: "produits_amiri.html"},
        {name: "Off-White", image: "./photos/off-white.png", link: "produits_off_white.html"}
    ];

    const brandGrid = document.querySelector('.featured-brands .brand-grid');
    let currentIndex = 0;

    const showBrands = () => {
        brandGrid.innerHTML = ''; // Effacer les marques précédentes

        // Sélectionner les marques à afficher
        const selectedBrands = brands.slice(currentIndex, currentIndex + 4);
        selectedBrands.forEach((brand) => {
            const brandItem = document.createElement('div');
            brandItem.classList.add('brand-item');
            brandItem.innerHTML = `
                <a href="${brand.link}">
                    <img src="${brand.image}" alt="${brand.name}">
                    <h3>${brand.name}</h3>
                </a>
            `;
            brandGrid.appendChild(brandItem);
        });

        // Mettre à jour l'index pour afficher les marques suivantes
        currentIndex = (currentIndex + 4) % brands.length;
    };

    // Initialiser les marques et configurer l'intervalle pour l'animation
    showBrands();
    setInterval(showBrands, 10000); // Changer les marques toutes les 10 secondes
});
