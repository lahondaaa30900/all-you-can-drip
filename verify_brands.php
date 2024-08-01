<?php
// Inclure le fichier de configuration pour la connexion à la base de données
include 'config.php';

// Liste des marques à vérifier
$marques_a_verifier = [
    'AIMÉ LEON DORE',
    'AMI',
    'ANTI SOCIAL SOCIAL CLUB',
    'ARC\'TERYX',
    'BALENCIAGA',
    'BAPE',
    'BURBERRY',
    'CARHARTT',
    'CHICAGO BULLS',
    'CPFM',
    'GUCCI',
    'NIKE',
    'THE NORTH FACE',
    'PALACE',
    'STUSSY',
    'TRAVIS SCOTT',
    'UNDER ARMOUR',
    'VETEMENTS',
    'VLONE',
    'VUJA DE',
    'YEEZY',
    'AIR FORCE 1',
    'AIR JORDAN',
    'ALEXANDER MCQUEEN',
    'CONVERSE',
    'DUNKS',
    'NEW BALANCE',
    'PUMA',
    'VANS',
    'ALYX',
    'AP ROYAL OAK',
    'BAPEX',
    'G-SHOCK',
    'ROLEX',
    'VAN CLEEF',
    'VIVIENNE WESTWOOD'
];

// Récupérer toutes les marques présentes dans la table
$sql = "SELECT nom FROM brands";
$result = $conn->query($sql);

$marques_presentes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $marques_presentes[] = $row['nom'];
    }
}

// Comparer les listes
$marques_manquantes = array_diff($marques_a_verifier, $marques_presentes);

if (empty($marques_manquantes)) {
    echo "Toutes les marques ont été insérées avec succès.";
} else {
    echo "Les marques suivantes sont manquantes : ";
    echo implode(', ', $marques_manquantes);
}

// Fermer la connexion
$conn->close();
?>
