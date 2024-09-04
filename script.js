document.addEventListener('DOMContentLoaded', () => {
    const categories = document.querySelectorAll('.category-item');
    const brands = document.querySelectorAll('.brand-item');
    const intervalTime = 10000; // 10 secondes
    let currentIndex = 0;

    // Initialisation : afficher les premières catégories et marques
    showItems(categories, currentIndex);
    showItems(brands, currentIndex);

    // Changer les catégories et marques toutes les 10 secondes
    setInterval(() => {
        fadeOutItems(categories, currentIndex, () => {
            fadeOutItems(brands, currentIndex, () => {
                currentIndex = (currentIndex + 4) % categories.length; // Passer à l'ensemble suivant
                fadeInItems(categories, currentIndex);
                fadeInItems(brands, currentIndex);
            });
        });
    }, intervalTime);

    function showItems(items, index) {
        for (let i = 0; i < items.length; i++) {
            items[i].style.display = (i >= index && i < index + 4) ? 'block' : 'none';
            items[i].style.opacity = (i >= index && i < index + 4) ? '1' : '0';
        }
    }

    function fadeOutItems(items, index, callback) {
        let opacity = 1;
        const fadeOutInterval = setInterval(() => {
            opacity -= 0.05;
            for (let i = index; i < index + 4 && i < items.length; i++) {
                items[i].style.opacity = opacity;
            }
            if (opacity <= 0) {
                clearInterval(fadeOutInterval);
                callback();
            }
        }, 50);
    }

    function fadeInItems(items, index) {
        let opacity = 0;
        showItems(items, index);
        const fadeInInterval = setInterval(() => {
            opacity += 0.05;
            for (let i = index; i < index + 4 && i < items.length; i++) {
                items[i].style.opacity = opacity;
            }
            if (opacity >= 1) {
                clearInterval(fadeInInterval);
            }
        }, 50);
    }
});

// Gestion du menu déroulant
document.addEventListener('DOMContentLoaded', () => {
    // Sélectionnez tous les éléments qui ont un menu déroulant
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        // Pour les appareils tactiles, ouvrez/fermez le menu déroulant au clic
        dropdown.addEventListener('click', function() {
            const dropdownContent = this.querySelector('.dropdown-content');
            const isVisible = dropdownContent.style.display === 'block';

            // Masquer tous les autres menus déroulants ouverts
            document.querySelectorAll('.dropdown-content').forEach(content => {
                content.style.display = 'none';
            });

            // Basculer l'affichage du menu cliqué
            dropdownContent.style.display = isVisible ? 'none' : 'block';
        });

        // Fermer le menu déroulant si on clique ailleurs sur la page
        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target)) {
                dropdown.querySelector('.dropdown-content').style.display = 'none';
            }
        });
    });
});
