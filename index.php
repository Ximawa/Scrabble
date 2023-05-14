<?php

require_once("connexionBDD.php");
session_start(); // Démarrage de la session

// Vérifier si l'utilisateur est connecté (s'il y a des informations de session)
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: PageConnexion.php');
    exit;
}

// Afficher les informations de l'utilisateur connecté
echo 'Bienvenue, ' . $_SESSION['nom_utilisateur'] . ' !';
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
        <img src="..\img\Logo_Epsi_Scrabble.png" alt="logo">
        <div>
            <button>
                Connexion
            </button>
            <button>
                creaction de compte
            </button>
        </div>

    </header>

    <main>
        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <div class="row">
                    <p class="col">affichage de profil</p>

                    <form method="post" action="" class="col">
                        <input type="submit" name="Creaction de la partie" value="Creaction de la partie">
                    </form>

                    <form method="post" action="" class="col">
                        <input type="submit" name="rejoindre la partie" value="rejoindre la partie">
                    </form>
                </div>
                
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