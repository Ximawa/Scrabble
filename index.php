<?php 
    require_once('./Structure_du_jeu/joueur.php');
    require_once('./Structure_du_jeu/scrabble.php');
    require_once('./Structure_du_jeu/plateau.php');

    session_start();

    $game = new Scrabble();
    $pioche = new Pioche();
    $toufik = new Joueur("toufik");
    $plateau = new Plateau();

    
    if(isset($_POST['pioche']) ){
        $toufik->PiocheDebutPartie($pioche);
        $_SESSION['toufik'] = $toufik;
    }

    if(isset($_POST['submit']) ){
        $mot = $_POST['selection'];
        $toufik = $_SESSION['toufik'];


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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href='affichage/style.css'>

    <title>Scrabble PHP</title>
</head>
<body>
    <header>
        <section>         
                <h1 ><img src="img\Logo_Epsi_Scrabble.png" alt="LOGO du jeu" >Scrabble</h1>
        </section>
        
    </header>

    <main>
       <section class="container-sm">
        <div class ="row ">
            <p class ="col">Player 1</p>
            <p class ="col">Score</p>
        
            <p class ="col">Player 2</p>
            <p class ="col">Score</p>
        </div>
    </section>
    
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

    <section class ="container-sm">
        <div class ="row">
            <p class ="col">Nb de lettres restant dans la pioche : <?php echo $pioche->nombrePieces(); ?></p> 
            <div class = "col" id="main">
                <?php
                    foreach($toufik->main as $piece){
                        echo "<input type=\"button\" value=\"". $piece->lettre."\" onClick=\"jouer(this.value)\" id=\"". $piece->lettre."\"./>";
                    }
                ?>
            </div>
            <form method="post" action="" class ="col">
                <input type="submit" name="pioche" value="Piocher"/>
            </form>
        </div>
       
        <div >
            <form name="fo" method="post" action="">
                <input type="hidden" name="selection">
                <input type="submit" name="submit" value="Check">
            </form>
        </div>
        <div id="selection">

        </div>
    </section>
    <script>
        function jouer(val) {
            document.getElementById(val).style.visibility = "hidden";
            document.getElementById("selection").innerHTML += '<input type="button" value="'+val+'">';
            document.fo.selection.value+=val;
        }
    </script>
    
        <div>
            <img src="./img/Plateau" alt="Plateau de jeu du Scrabble">
        </div>

    </main>

    <footer>
        
        <p>SCORE BOARD</p>
    </footer>  
    
</body>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">





</script>