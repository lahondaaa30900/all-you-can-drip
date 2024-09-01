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
// Par exemple : sliders, animations, chargement dynamique des produits, etc.
