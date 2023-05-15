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

    echo '<div> Historique de partie </div>';
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