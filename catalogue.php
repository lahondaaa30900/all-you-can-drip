<?php
include 'config.php';

// Récupérer les catégories
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    echo "<div class='categories-list'>";
    while($cat = $result_categories->fetch_assoc()) {
        echo "<div class='category-section'>";
        echo "<h2>" . $cat['name'] . "</h2>"; // Assuming 'name' is the column name in the 'categories' table

        // Récupérer les produits pour chaque catégorie
        $sql_products = "SELECT products.name AS product_name, products.description, products.price, products.image, brands.name AS brand_name
                         FROM products
                         JOIN brands ON products.brand_id = brands.id
                         WHERE products.category_id = " . $cat['id'];
        $result_products = $conn->query($sql_products);

        if ($result_products->num_rows > 0) {
            echo "<div class='products-grid'>";
            while($row = $result_products->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['product_name'] . "'>";
                echo "<h3>" . $row['product_name'] . "</h3>";
                echo "<p>Marque: " . $row['brand_name'] . "</p>";
                echo "<p>" . $row['description'] . "</p>";
                if (isset($row['price'])) {
                    echo "<p>Prix: $" . $row['price'] . "</p>";
                }
                echo "</div>";
            }
            echo "</div>"; // Fin de .products-grid
        } else {
            echo "<p>Aucun produit trouvé pour cette catégorie.</p>";
        }
        echo "</div>"; // Fin de .category-section
    }
    echo "</div>"; // Fin de .categories-list
} else {
    echo "<p>Aucune catégorie trouvée.</p>";
}

$conn->close();
?>
