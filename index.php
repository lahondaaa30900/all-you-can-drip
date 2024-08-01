<?php
include 'config.php';

// Récupérer les catégories
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    while($cat = $result_categories->fetch_assoc()) {
        echo "<h2>" . $cat['nom'] . "</h2>";

        // Récupérer les produits pour chaque catégorie
        $sql_products = "SELECT products.nom AS produit_nom, products.description, products.prix, products.image, brands.nom AS marque_nom
                         FROM products
                         JOIN brands ON products.marque_id = brands.id
                         WHERE products.categorie_id = " . $cat['id'];
        $result_products = $conn->query($sql_products);

        if ($result_products->num_rows > 0) {
            while($row = $result_products->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['produit_nom'] . "'>";
                echo "<h3>" . $row['produit_nom'] . "</h3>";
                echo "<p>Marque: " . $row['marque_nom'] . "</p>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>Prix: $" . $row['prix'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Aucun produit trouvé pour cette catégorie.</p>";
        }
    }
} else {
    echo "<p>Aucune catégorie trouvée.</p>";
}

$conn->close();
?>
