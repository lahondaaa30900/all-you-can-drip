<?php
include 'config.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données

// Récupérer les catégories et marques depuis la base de données
$sql_categories = "SELECT id, name FROM categories";
$result_categories = $conn->query($sql_categories);

$sql_brands = "SELECT id, name FROM brands ORDER BY RAND() LIMIT 4";
$result_brands = $conn->query($sql_brands);
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
    <header class="header">
    <div class="container">
        <div class="logo">
            <a href="#"><img src="./photos/logo2.png" alt="Logo de l'entreprise"></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li class="dropdown">
                    <a href="produits.php">Catégorie</a>
                    <ul class="dropdown-content">
                        <?php
                        // Récupérer les catégories depuis la base de données
                        $sql_categories = "SELECT id, name FROM categories";
                        $result_categories = $conn->query($sql_categories);

                        // Afficher chaque catégorie dans le menu déroulant
                        if ($result_categories->num_rows > 0) {
                            while ($row = $result_categories->fetch_assoc()) {
                                echo "<li><a href='produits.php?categorie_id=" . $row['id'] . "'>" . $row['name'] . "</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="catalogue.php">Catalogue</a>
                    <ul class="dropdown-content">
                        <li><a href="marques.php">Marques</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="search-bar-wrapper">
            <input type="text" class="search-input" placeholder="Rechercher un produit...">
            <button class="search-btn"><i class="fas fa-search"></i></button>
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
            <div class="category-grid">
                <?php
                // Afficher les catégories
                if ($result_categories->num_rows > 0) {
                    while ($row = $result_categories->fetch_assoc()) {
                        $category_name = $row['name'];
                        $category_link = strtolower(str_replace(' ', '_', $category_name)) . ".php";
                        $image_path = "./photos/categorie" . strtolower(str_replace(' ', '', $category_name)) . ".png";
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
                // Afficher les marques
                if ($result_brands->num_rows > 0) {
                    while ($row = $result_brands->fetch_assoc()) {
                        $brand_name = $row['name'];
                        $brand_link = "produits.php?brand_id=" . $row['id'];
                        $image_path = "./photos/" . strtolower(str_replace(' ', '-', $brand_name)) . ".png";
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
