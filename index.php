<?php 
    require_once("joueur.php");
    require_once("scrabble.php");

    $game = new Scrabble();
    $pioche = new Pioche();
    $toufik = new Joueur("toufik");

    if(isset($_POST['pioche'])){
        $toufik->PiocheDebutPartie($pioche);
    }

    if(isset($_POST['submit'])){
        $mot = $_POST['mot'];
        if($game->verifMotComposition($mot, $toufik->main) == true){
            echo "<h2>Mot bien composé de vos lettre </h2>";
            if($game->verifMotValide($mot) == true){
                echo "<h3>Mot valide </h3>";
            }else{
                echo "<h3>Mot non valide</h3>";
            }
        }else{
            echo "<h2>Le mot n'est pas compose des lettres dans votre main</h2>";
        }

        
    }
?>
<html>
<head>
    <title>Scrabble Game</title>
</head>
<body>
    <h1>Scrabble Game</h1>
    <div>
        Vos lettres:
    </div>
    <div>
        <?php
            foreach($toufik->main as $piece){
                echo $piece->lettre. " ";
            }
        ?>
    </div>
    <form method="post" action="">
        <input type="submit" name="pioche" value="Piocher"/>
        <br>
        <label for="mot">Enter a word:</label>
        <input type="text" name="mot" id="mot">
        <input type="submit" name="submit" value="Check">
    </form>
</body>
</html>