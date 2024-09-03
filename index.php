<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "catalogue");

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les catégories depuis la base de données
$sql_categories = "SELECT id, name FROM categories";
$result_categories = $conn->query($sql_categories);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue de Produits</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="#"><img src="./photos/logo2.png" alt="Logo de l'entreprise"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="teeshirt.php">Teeshirts</a></li>
                    <li><a href="pulls.php">Pulls</a></li>
                    <li><a href="baskets.php">Baskets</a></li>
                    <li><a href="accessoires.php">Accessoires</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher un produit...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>

    <!-- Bannière Principale -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Bienvenue sur notre catalogue.</h1>
                <p>Découvrez nos larges gamme de produits à prix réduits !</p>
                <a href="catalogue.php" class="btn">Voir le catalogue</a>
            </div>
        </div>
    </section>

    <!-- Catégories de Produits (Carrousel) -->
    <section class="categories">
        <div class="container">
            <h2>Nos Catégories</h2>
            <div class="category-carousel">
                <?php
                // Afficher chaque catégorie
                if ($result_categories->num_rows > 0) {
                    while ($row = $result_categories->fetch_assoc()) {
                        $category_name = $row['name'];
                        $category_link = strtolower(str_replace(' ', '_', $category_name)) . ".php"; // Supposition : lien du fichier correspondant à chaque catégorie
                        $image_path = "./photos/" . strtolower(str_replace(' ', '', $category_name)) . ".png"; // Supposition : chemin de l'image
                        echo "
                        <div class='category-item'>
                            <a href='{$category_link}' target='_blank'><img src='{$image_path}' alt='{$category_name}' /></a>
                            <h3>{$category_name}</h3>
                        </div>";
                    }
                } else {
                    echo "<p>Aucune catégorie trouvée.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Section des marques -->
    <section class="featured-brands">
        <div class="container">
            <h2>Nos Marques</h2>
            <div class="brand-grid">
                <?php
                // Récupérer les marques depuis la base de données
                $sql_brands = "SELECT id, name FROM brands LIMIT 4"; // Supposition : afficher 4 marques à la une
                $result_brands = $conn->query($sql_brands);

                if ($result_brands->num_rows > 0) {
                    while ($row = $result_brands->fetch_assoc()) {
                        $brand_name = $row['name'];
                        $brand_link = "produits.php?brand_id=" . $row['id']; // Lien vers la page produits avec le brand_id
                        $image_path = "./photos/" . strtolower(str_replace(' ', '-', $brand_name)) . ".png"; // Supposition : chemin de l'image
                        echo "
                        <div class='brand-item'>
                            <a href='{$brand_link}'><img src='{$image_path}' alt='{$brand_name}'></a>
                            <h3>{$brand_name}</h3>
                        </div>";
                    }
                } else {
                    echo "<p>Aucune marque trouvée.</p>";
                }
                ?>
            </div>
            <div class="view-more">
                <a href="marques.php" class="btn">Voir plus</a>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer>
        <div class="container">
            <div class="footer-section">
                <h3>À propos</h3>
                <p>Bienvenue sur AYCD ! Votre catalogue avec une grande diversité de marques.</p>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Téléphone : +33 1 23 45 67 89</p>
                <p>Email : contact@example.com</p>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/all.you.can.drip" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AYCD. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
