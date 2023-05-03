<?php 
    require_once('./Structure_du_jeu/joueur.php');
    require_once('./Structure_du_jeu/scrabble.php');
    require_once('./Structure_du_jeu/plateau.php');

    $game = new Scrabble();
    $pioche = new Pioche();
    $toufik = new Joueur("toufik");
    $plateau = new Plateau();


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
                    <input type="button" value="<?php echo $cell->getLettre() ?>" />
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
    </section>
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