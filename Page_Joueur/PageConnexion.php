<?php

require_once("connexionBDD.php");
session_start();



// Connexion à la base de données MySQL
$pdo = new PDO("mysql:host=$servername;dbname=$BDDname", $nom_utilisateur, $motdepasse);

// Vérification des informations de connexion
if (isset($_POST['nom']) && isset($_POST['motdepasse'])) {

    $username = $_POST['nom'];
    $password = $_POST['motdepasse'];

    $query = "SELECT * FROM joueurs WHERE nom_joueur = :nom_joueur AND mdp = :mdp";
    $statement = $pdo->prepare($query);
    $statement->execute(['nom_joueur' => $username, 'mdp' => $password]);

    if ($statement->rowCount() > 0) {
        $joueur = $statement->fetch();
        $_SESSION['id_utilisateur'] = $joueur['Id'];
        $_SESSION['nom_utilisateur'] = $joueur['nom_joueur'];

        // L'utilisateur est authentifié, rediriger vers la page d'accueil de l'application
        header('Location: ../index.php');
        exit();
    } else {

        // Les informations de connexion sont invalides, afficher un message d'erreur
        $erreur = "Nom d'utilisateur ou mot de passe incorrect";
        echo $erreur;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="..\affichage\styleHome.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header>
        <a href="./../index.php">
            <img src="..\img\Logo_Epsi_Scrabble.png" alt="logo">
        </a>

    </header>

    <main>
        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <div>
                    <center>
                        <form action="" method="post">
                            <label for="nom">Nom d'utilisateur :</label>
                            <input type="text" id="nom_joueur" name="nom"><br><br>

                            <label for="motdepasse">Mot de passe :</label>
                            <input type="password" id="motdepasse" name="motdepasse"><br><br>
                            <input type="submit" value="Ce connecter" class="btn btn-primary">
                        </form>
                    </center>
                </div>

            </div>

        </section>

    </main>

    <footer>
        <section class="container mt-2">
            <div class="row">
                <li class="col"><a href="">Contact</a></li>
                <li class="col"><a href="">Conditions d'utilisation</a></li>
                <li class="col"><a href="">Credits</a></li>
                <li class="col"><a href="">Paramètres de confidentialité</a></li>
            </div>

        </section>
        <center>
            <p>Le propriétaire de ce site n’est pas responsable du contenu généré par l’utilisateur (mot utiliser,
                messages, noms d’utilisateur)</p>
        </center>

    </footer>

</body>

</html>