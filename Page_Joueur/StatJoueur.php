<?php
    require_once("connexionBDD.php");
    session_start();


    $stmt = $connb->prepare("SELECT * FROM statpartie WHERE Id_joueur = :id_joueur");
    $id_joueur = $_SESSION['id_utilisateur'];
    $stmt->bindParam(':id_joueur',$id_joueur);

    $stmt->execute();
    $resultats = $stmt->fetchAll();

    $score = 0;
    $nb_mot_total = 0;
    $score_moyen = 0;
    $score_moyen_mot = 0;
    $nb_mot_moyen = 0;
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
    <title>Scrabble PHP</title>
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
                        echo'<div class="space3">';
                           echo '<div> <h1> Historique de partie </h1>';
    foreach($resultats as $resultat){
        $nb_mot_total += $resultat["nb__mot_jouer"];
        $score += $resultat["score"];
        echo "ID partie : " . $resultat["Id_partie"] . "<br>";
        echo "Score : " . $resultat["score"] . "<br>";
        echo "Nombre de mot jouer : " . $resultat["nb__mot_jouer"] . "<br>";
    }


    echo '<br><div> Statistique du compte </div>';
    echo 'Nb mot jouer au total : '.$nb_mot_total. "<br>";;
    echo 'Score moyen par partie : '.($score / count($resultats)). "<br>";;
    echo 'Score moyen par mot :'.($score / $nb_mot_total). "<br>";;
    echo 'Moyenne de mot posé par partie : '.($nb_mot_total / count($resultats)). "<br>";;



?>