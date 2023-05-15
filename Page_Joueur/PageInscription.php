<?php
require_once("connexionBDD.php");
session_start();

$conn = new mysqli($servername, $nom_utilisateur, $motdepasse, $BDDname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $mdp = $_POST["motdepasse"];
    $confmdp = $_POST["confmotdepasse"];
    
    

    // Vérification si le mot de passe correspond à la confirmation
    if ($mdp != $confmdp) {
        echo "Le mot de passe et la confirmation ne correspondent pas.";
    } else {

        $mdpcrypter = password_hash($mdp, PASSWORD_BCRYPT);
        
        // Enregistrement des données dans la table "utilisateurs"
        $sql = "INSERT INTO joueurs (nom_joueur, mdp) VALUES ('$nom', '$mdpcrypter')";
        if ($conn->query($sql) === TRUE) {
            echo "Inscription réussie.";
            header('Location: PageConnexion.php');
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error;
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="..\affichage\styleHome.css" rel="stylesheet" >
    <title>Document</title>
</head>
<body>
    <header>
        <a href="./../index.php">
            <img class ="logoco" src="..\img\Logo_Epsi_Scrabble.png" alt="logo">
        </a>
       
    </header>

    <main>
        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <center>
                <form method="post" action="">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom"><br><br>
                    
                    <label for="motdepasse">Mot de passe :</label>
                    <input type="password" id="motdepasse" name="motdepasse"><br><br>
                    
                    <label for="confmotdepasse">Confirmez le mot de passe :</label>
                    <input type="password" id="confmotdepasse" name="confmotdepasse"><br><br>
                    
                    <input type="submit" value="S'inscrire" class="btn btn-primary">
                </form>
                </center>
                   
            </div>
                
        </section>

    </main>

    <footer>
        <section class="container mt-2">
            <div class="row">
                <li class = "col"><a href="">Contact</a></li>
                <li class = "col"><a href="">Conditions d'utilisation</a></li>
                <li class = "col"><a href="">Credits</a></li>
                <li class = "col"><a href="">Paramètres de confidentialité</a></li>
            </div>
            
        </section>
        <center>
            <p>Le propriétaire de ce site n’est pas responsable du contenu généré par l’utilisateur (mot utiliser, messages, noms d’utilisateur)</p>
        </center>
        
    </footer>

</body>
</html>