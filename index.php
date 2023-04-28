<?php 
    require_once("joueur.php");
    require_once("scrabble.php");
    require_once("plateau.php");

    $game = new Scrabble();
    $pioche = new Pioche();
    $toufik = new Joueur("toufik");
    $plateau = new Plateau();

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
    <link href="style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <title>Scrabble PHP</title>
</head>
<body>
    <h1>Scrabble</h1>
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
    <div>
        Nb de lettres restant dans la pioche : <?php echo $pioche->nombrePieces(); ?>
    </div>
    <form method="post" action="">
        <input type="submit" name="pioche" value="Piocher"/>
        <br>
        <label for="mot">Enter a word:</label>
        <input type="text" name="mot" id="mot">
        <input type="submit" name="submit" value="Check">
    </form>
    <div id="plateau">
        <?php
            foreach($plateau->cellules as $line){
                foreach($line as $cell){
        ?>
                    <input type="button" value="<?php echo $cell->getBonus() ?>" />
        <?php
                }
                echo "<br>";
            }

        ?>
    </div>
</body>
</html>