// script.js

// Fonctionnalité de recherche (exemple simple)
const searchInput = document.querySelector('.search-bar input');
const searchButton = document.querySelector('.search-bar button');

searchButton.addEventListener('click', () => {
  const query = searchInput.value.trim();
  if (query !== '') {
    // Rediriger vers une page de résultats de recherche ou filtrer les produits affichés
    alert(`Vous avez recherché : ${query}`);
    // Implémentez la logique de recherche ici
  }
});

// Fonctionnalités supplémentaires peuvent être ajoutées ici
document.addEventListener('DOMContentLoaded', () => {
    const brands = [
        {name: "Marque 1", image: "./photos/marque1.png", link: "produits_marque1.html"},
        {name: "Marque 2", image: "./photos/marque2.png", link: "produits_marque2.html"},
        {name: "Marque 3", image: "./photos/marque3.png", link: "produits_marque3.html"},
        {name: "Marque 4", image: "./photos/marque4.png", link: "produits_marque4.html"},
        {name: "Marque 5", image: "./photos/marque5.png", link: "produits_marque5.html"},
        {name: "Marque 6", image: "./photos/marque6.png", link: "produits_marque6.html"}
    ];

    const brandGrid = document.querySelector('.featured-brands .brand-grid');
    brandGrid.innerHTML = '';

    // Afficher aléatoirement 4 marques
    const shuffledBrands = brands.sort(() => 0.5 - Math.random()).slice(0, 4);

    shuffledBrands.forEach(brand => {
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
});

// Par exemple : sliders, animations, chargement dynamique des produits, etc.
