<?php
    require_once('joueur.php');
    require_once("../Page_joueur/connexionBDD.php");

    session_start();

    $score = $_SESSION['joueur1']->score;
    $nb_mot_jouer = $_SESSION['joueur1']->nbMotJouer;
    $id_joueur = $_SESSION['id_utilisateur'];
    $id_partie = $_SESSION['id_partie'];


    $sql = "INSERT INTO statpartie (score, nb__mot_jouer, id_joueur, id_partie) VALUES ('$score', '$nb_mot_jouer', '$id_joueur', '$id_partie')";
    if($connb->query($sql) == TRUE){
        echo "stat ajouter en base de données";
    }else{
        echo "Error while adding statpartie to database";
    }
    

    if($_SESSION['joueur1']->score > $_SESSION['joueur2']->score){
        echo "<br>";
        echo $_SESSION['joueur1']->nom." gagne la partie avec un score de ".$_SESSION['joueur1']->score;
        echo "<br>";
        echo $_SESSION['joueur2']->nom." perd avec un score de ".$_SESSION['joueur2']->score;
    }else{
        echo "<br>";
        echo $_SESSION['joueur2']->nom." gagne la partie avec un score de ".$_SESSION['joueur2']->score;
        echo "<br>";
        echo $_SESSION['joueur1']->nom." perd avec un score de ".$_SESSION['joueur1']->score;
    }


?>