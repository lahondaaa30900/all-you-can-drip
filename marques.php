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
    <title>Nos Marques</title>
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
                    <li><a href="teeshirt.html">Teeshirts</a></li>
                    <li><a href="./pulls.html">Pulls</a></li>
                    <li><a href="baskets.html">Baskets</a></li>
                    <li><a href="accessoires.html">Accessoires</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher un produit...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>

    <!-- Section des marques -->
    <main>
        <div class="brands">
            <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "root", "catalogue");

            // Vérifiez la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Récupérer toutes les marques
            $sql = "SELECT id, name FROM brands";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Afficher chaque marque
                while($row = $result->fetch_assoc()) {
                    $brand_id = $row['id'];
                    $brand_name = $row['name'];
                    $image_path = strtolower(str_replace(' ', '_', $brand_name)) . ".png"; // Assumer que les images suivent un schéma de nommage simple
                    echo "<div class='brand'>";
                    echo "<a href='produits.php?brand_id={$brand_id}'><img src='./photos/{$image_path}' alt='{$brand_name}'></a>";
                    echo "<p><a href='produits.php?brand_id={$brand_id}'>{$brand_name}</a></p>";
                    echo "</div>";
                }
            } else {
                echo "Aucune marque trouvée.";
            }

            // Fermer la connexion
            $conn->close();
            ?>
        </div>
    </main>

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
