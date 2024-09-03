<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "catalogue");

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer le brand_id ou category_id depuis l'URL
$brand_id = isset($_GET['brand_id']) ? intval($_GET['brand_id']) : null;
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

// Construire la requête SQL selon les paramètres
if ($brand_id && $category_id) {
    $sql = "SELECT products.name, products.description, products.image, categories.name AS category, brands.name AS brand
            FROM products
            JOIN categories ON products.category_id = categories.id
            JOIN brands ON products.brand_id = brands.id
            WHERE products.brand_id = ? AND products.category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $brand_id, $category_id);
} elseif ($brand_id) {
    $sql = "SELECT products.name, products.description, products.image, categories.name AS category, brands.name AS brand
            FROM products
            JOIN categories ON products.category_id = categories.id
            JOIN brands ON products.brand_id = brands.id
            WHERE products.brand_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $brand_id);
} elseif ($category_id) {
    $sql = "SELECT products.name, products.description, products.image, categories.name AS category, brands.name AS brand
            FROM products
            JOIN categories ON products.category_id = categories.id
            JOIN brands ON products.brand_id = brands.id
            WHERE products.category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
} else {
    // Si aucun brand_id ou category_id n'est passé, afficher tous les produits
    $sql = "SELECT products.name, products.description, products.image, categories.name AS category, brands.name AS brand
            FROM products
            JOIN categories ON products.category_id = categories.id
            JOIN brands ON products.brand_id = brands.id";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="#"><img src="./photos/logo2.png" alt="Company Logo"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="teeshirt.html">T-shirts</a></li>
                    <li><a href="pulls.html">Hoodies</a></li>
                    <li><a href="baskets.html">Sneakers</a></li>
                    <li><a href="accessoires.html">Accessories</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Search for a product...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>

    <!-- Products Section -->
    <main>
        <div class="container">
            <h1>Vos produits</h1>
            <div class="products">
                <?php
                // Display the products
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<p>Category: " . $row['category'] . "</p>";
                    echo "<p>Brand: " . $row['brand'] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Welcome to AYCD! Your catalogue with a wide range of brands.</p>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Phone: +33 1 23 45 67 89</p>
                <p>Email: contact@example.com</p>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/all.you.can.drip" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AYCD. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
