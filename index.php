<?php 

    
    require_once("joueur.php");
    require_once("scrabble.php");
    require_once("plateau.php");

    session_start();

    $game = new Scrabble();
    $pioche = new Pioche();
    $toufik = new Joueur("toufik");
    $plateau = new Plateau();

    

    // if(!isset($_SESSION['toufik'])){
    //     $toufik->PiocheDebutPartie($pioche);
    //     $_SESSION['toufik'] = $toufik;
    //     var_dump($toufik->main);
    // } 

    if(isset($_POST['pioche']) ){
        $toufik->PiocheDebutPartie($pioche);
        $_SESSION['toufik'] = $toufik;
    }

    if(isset($_POST['submit']) ){
        $mot = $_POST['mot'];
        $toufik = $_SESSION['toufik'];
        // var_dump($toufik->main);
        // var_dump($mot);
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
    <div id="piece">
        <?php
            foreach($toufik->main as $piece){
        ?>
                <input type="button" value="<?php echo $piece->lettre ?>" id="<?php echo $piece->lettre ?>" onClick="jouer(this.value)" /> 
            <?php } ?>
    </div>
    <div>
        Nb de lettres restant dans la pioche : <?php echo $pioche->nombrePieces(); ?>
    </div>
    <form name="pioche" method="post">
        <input type="submit" name="pioche" value="Piocher"/>
    </form>
    <form method="post" action="validationMot.php" name="fo">
        
        <input type="submit" name="valide" value="Check Validité"/>
        <input type="hidden" name="selection" />
    </form>
    <div id="motSelection">
    </div>
    <div id="plateau">
        <?php
            foreach($plateau->cellules as $line){
                foreach($line as $cell){
        ?>
                    <input type="button" value="<?php echo $cell->getBonus() ?>" id="<?php echo $cell->getPosX()."/".$cell->getPosY() ?>" />
        <?php
                }
                echo "<br>";
            }

        ?>
    </div>
    <script>
        function jouer(value){
            document.getElementById(value).style.visibility="hidden";
            document.getElementById("motSelection").innerHTML+='<input type="button" value="'+value+'"  />';
            document.fo.selection.value+=value;

        }
    </script>
</body>
</html>