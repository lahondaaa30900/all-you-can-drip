<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Par défaut pour MAMP
$dbname = "catalogue";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
