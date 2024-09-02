<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "catalogue");

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer le marque_id ou categorie_id depuis l'URL
$marque_id = isset($_GET['marque_id']) ? intval($_GET['marque_id']) : null;
$categorie_id = isset($_GET['categorie_id']) ? intval($_GET['categorie_id']) : null;

// Construire la requête SQL selon les paramètres
if ($marque_id) {
    $sql = "SELECT products.nom, products.description, products.prix, products.image, categories.nom AS categorie, brands.nom AS marque
            FROM products
            JOIN categories ON products.categorie_id = categories.id
            JOIN brands ON products.marque_id = brands.id
            WHERE products.marque_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $marque_id);
} elseif ($categorie_id) {
    $sql = "SELECT products.nom, products.description, products.prix, products.image, categories.nom AS categorie, brands.nom AS marque
            FROM products
            JOIN categories ON products.categorie_id = categories.id
            JOIN brands ON products.marque_id = brands.id
            WHERE products.categorie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categorie_id);
} else {
    // Si aucun marque_id ou categorie_id n'est passé, afficher tous les produits
    $sql = "SELECT products.nom, products.description, products.prix, products.image, categories.nom AS categorie, brands.nom AS marque
            FROM products
            JOIN categories ON products.categorie_id = categories.id
            JOIN brands ON products.marque_id = brands.id";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="container">
        <div class="logo">
                <a href="index.html"><img src="./photos/logo2.png" alt="Logo de l'entreprise"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="teeshirt.html">Teeshirts</a></li>
                    <li><a href="pulls.html">Pulls</a></li>
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

    <!-- Section des produits -->
    <main>
        <div class="container">
            <h1>Nos Produits</h1>
            <div class="products">
                <?php
                // Afficher les produits
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . $row['image'] . "' alt='" . $row['nom'] . "'>";
                    echo "<h3>" . $row['nom'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<p>Prix : " . $row['prix'] . " €</p>";
                    echo "<p>Catégorie : " . $row['categorie'] . "</p>";
                    echo "<p>Marque : " . $row['marque'] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
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
</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
