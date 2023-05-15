<?php
    require_once("connexionBDD.php");
    session_start();


    $stmt = $connb->prepare("SELECT * FROM statpartie WHERE Id_joueur = :id_joueur");
    $id_joueur = $_SESSION['id_utilisateur'];
    $stmt->bindParam(':id_joueur',$id_joueur);

    $stmt->execute();
    $resultats = $stmt->fetchAll();

    echo '<div> Historique de partie </div>';
    foreach($resultats as $resultat){
        echo "ID partie : " . $resultat["Id_partie"] . "<br>";
        echo "Score : " . $resultat["score"] . "<br>";
        echo "Nombre de mot jouer : " . $resultat["nb__mot_jouer"] . "<br>";
    }

?>