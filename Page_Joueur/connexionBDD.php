<?php

// Informations de connexion à la base de données
$servername = "localhost:3302";
$nom_utilisateur = "root";
$motdepasse = "";
$BDDname = "projet_scrabble";

try {
    // Créer une connexion PDO à la base de données
    $connb = new PDO("mysql:host=$servername;dbname=$BDDname", $nom_utilisateur, $motdepasse);
    // Définir le mode d'erreur PDO à exception
    $connb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>