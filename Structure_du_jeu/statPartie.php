<?php
    require_once('joueur.php');
    require_once("../Page_joueur/connexionBDD.php");

    session_start();

    $score = $_SESSION['joueur1']->score;
    $nb_mot_jouer = $_SESSION['joueur1']->nbMotJouer;
    if(isset($_SESSION['id_utilisateur'])){
        $id_joueur = $_SESSION['id_utilisateur'];
        $id_partie = $_SESSION['id_partie'];
        $sql = "INSERT INTO statpartie (score, nb__mot_jouer, id_joueur, id_partie) VALUES ('$score', '$nb_mot_jouer', '$id_joueur', '$id_partie')";
        if($connb->query($sql) == TRUE){
            echo "stat ajouter en base de données";
        }else{
            echo "Error while adding statpartie to database";
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
            <img class ="logoco" src="..\img\Logo_Epsi_Scrabble.png" alt="logo">
        </a>

    </header>

    <main>
        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <div>
                    <center>
                        <p><?php
                            if($_SESSION['joueur1']->score > $_SESSION['joueur2']->score){
                            echo "<br><br>";
                            echo $_SESSION['joueur1']->nom." gagne la partie avec un score de ".$_SESSION['joueur1']->score;
                            echo "<br><br>";
                            echo $_SESSION['joueur2']->nom." perd avec un score de ".$_SESSION['joueur2']->score;
                            }else{
                            echo "<br><br>";
                            echo $_SESSION['joueur2']->nom." gagne la partie avec un score de ".$_SESSION['joueur2']->score;
                            echo "<br><br>";
                            echo $_SESSION['joueur1']->nom." perd avec un score de ".$_SESSION['joueur1']->score;
                        }?>
                        </p>
                        <br>
                        <br>
                       <a href="../index.php" class="btn btn-primary">retour au menu</a>
                        
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