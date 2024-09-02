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
document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const marque = params.get('marque');

    const produits = [
        { id: 1, name: "T-shirt Nike", marque: "Nike", category: "T-shirt", image: "./photos/produit_nike1.png" },
        { id: 2, name: "Basket Adidas", marque: "Adidas", category: "Baskets", image: "./photos/produit_adidas1.png" },
        { id: 3, name: "Pull Gucci", marque: "Gucci", category: "Pulls", image: "./photos/produit_gucci1.png" },
        { id: 4, name: "Basket Puma", marque: "Puma", category: "Baskets", image: "./photos/produit_puma1.png" },
        { id: 5, name: "T-shirt Louis Vuitton", marque: "Louis Vuitton", category: "T-shirt", image: "./photos/produit_lv1.png" },
        { id: 6, name: "Accessoire Dior", marque: "Christian Dior", category: "Accessoires", image: "./photos/produit_dior1.png" },
        { id: 7, name: "T-shirt Palm Angels", marque: "Palm Angels", category: "T-shirt", image: "./photos/produit_palm1.png" },
        { id: 8, name: "Basket Air Jordan", marque: "Air Jordan", category: "Baskets", image: "./photos/produit_jordan1.png" },
        { id: 9, name: "Accessoire Celine", marque: "Celine", category: "Accessoires", image: "./photos/produit_celine1.png" },
        { id: 10, name: "Pull Burberry", marque: "Burberry", category: "Pulls", image: "./photos/produit_burberry1.png" },
        { id: 11, name: "T-shirt Calvin Klein", marque: "Calvin Klein", category: "T-shirt", image: "./photos/produit_ck1.png" },
        { id: 12, name: "Basket New Balance", marque: "New Balance", category: "Baskets", image: "./photos/produit_nb1.png" },
        { id: 13, name: "T-shirt Amiri", marque: "Amiri", category: "T-shirt", image: "./photos/produit_amiri1.png" },
        { id: 14, name: "Accessoire Off-White", marque: "Off-White", category: "Accessoires", image: "./photos/produit_offwhite1.png" },
        // Ajoutez d'autres produits ici en fonction de votre catalogue
    ];

    const filteredProduits = produits.filter(produit => produit.marque === marque);

    const productsContainer = document.querySelector('.products');
    productsContainer.innerHTML = '';

    filteredProduits.forEach(produit => {
        const productElement = document.createElement('div');
        productElement.classList.add('product-item');
        productElement.innerHTML = `
            <img src="${produit.image}" alt="${produit.name}">
            <h3>${produit.name}</h3>
            <p>Catégorie: ${produit.category}</p>
        `;
        productsContainer.appendChild(productElement);
    });
});
function afficherProduitsFiltrés(categorie, marque) {
    // Exemple de données produits (à remplacer par vos vraies données)
    const produits = [
        { id: 1, name: "T-shirt Nike", marque: "Nike", category: "T-shirt", image: "./photos/produit_nike1.png" },
        { id: 2, name: "Basket Adidas", marque: "Adidas", category: "Baskets", image: "./photos/produit_adidas1.png" },
        { id: 3, name: "Pull Gucci", marque: "Gucci", category: "Pulls", image: "./photos/produit_gucci1.png" },
        // Ajoutez plus de produits ici
    ];

    // Filtrer les produits par catégorie et marque
    const filteredByCategoryAndBrand = produits.filter(produit => 
        produit.category === categorie && produit.marque === marque
    );

    // Sélectionner l'élément HTML où les produits seront affichés
    const productsContainer = document.querySelector('.products');
    productsContainer.innerHTML = '';

    // Afficher les produits filtrés
    filteredByCategoryAndBrand.forEach(produit => {
        const productElement = document.createElement('div');
        productElement.classList.add('product-item');
        productElement.innerHTML = `
            <img src="${produit.image}" alt="${produit.name}">
            <h3>${produit.name}</h3>
            <p>Catégorie: ${produit.category}</p>
        `;
        productsContainer.appendChild(productElement);
    });
}

// Exemple d'utilisation
document.addEventListener('DOMContentLoaded', () => {
    // Supposons que vous ayez des paramètres dynamiques pour la catégorie et la marque
    const categorie = "T-shirt"; // Ex. : récupéré d'une sélection utilisateur
    const marqueFilter = "Nike"; // Ex. : récupéré d'une sélection utilisateur

    // Appeler la fonction pour afficher les produits filtrés
    afficherProduitsFiltrés(categorie, marqueFilter);
});
