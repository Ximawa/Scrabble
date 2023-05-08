<?php
    require_once('joueur.php');
    session_start();

    echo $_SESSION['joueur1']->nom;
    echo $_SESSION['joueur1']->score;

    echo $_SESSION['joueur2']->nom;
    echo $_SESSION['joueur2']->score;

?>