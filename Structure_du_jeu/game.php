<?php 
    require_once('./Structure_du_jeu/joueur.php');
    require_once('./Structure_du_jeu/scrabble.php');


    session_start();

    $game = new Scrabble();
    $pioche = new Pioche();
    $toufik = new Joueur("toufik");



    if(isset($_POST['pioche'])){
        $toufik->PiocheDebutPartie($pioche);
        $_SESSION['toufik'] = $toufik;
    }

    if(isset($_POST['submit'])){
        $mot = $_POST['mot'];
        $direction = $_POST['direction'];
        $posX = $_POST['posX'];
        $posY = $_POST['posY'];
        $toufik = $_SESSION['toufik'];

        echo $game->poserMot($mot, $toufik, $direction, $posX, $posY);
        
    }

?>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href='../affichage/style.css'>
    <title>Scrabble PHP</title>
</head>
<body>
    <header>
        <section>         
                <h1><img src="../img\Logo_Epsi_Scrabble.png" alt="LOGO du jeu">Scrabble</h1>
        </section>      
    </header>
    <main>
    <div id="plateau">
        <?php
            foreach($game->plateau->cellules as $line){
                foreach($line as $cell){
        ?>
                    <input type="text" value="<?php echo $cell->getLettre() ?>"  readonly/>
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
                        echo "<input type=\"button\" value=\"". $piece->lettre."\"  />";
                    }
                ?>
            </div>
            <form method="post" action="" class ="col">
                <input type="submit" name="pioche" value="Piocher"/>
            </form>
        </div>
        <div >
            <form name="submit" method="post" action="">
                <input type="text" name="mot">
                <select name="direction">
                    <option value="">--Choissisez un sens--</option>
                    <option value="hori">Horizontale</option>
                    <option value="verti">verticale</option>
                </select>
                <select name="posX">
                    <option value="">--Choissisez une PosX--</option>
                    <?php
                    for($x=1; $x<16; $x++){
                        echo '<option value='.$x.'>'.$x.'</option>';
                    }
                    ?>
                </select>
                <select name="posY">
                    <option value="">--Choissisez une PosY--</option>
                    <?php
                    for($y=1; $y<16; $y++){
                        echo '<option value='.$y.'>'.$y.'</option>';
                    }
                    ?>
                </select>
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

        <section class="footer">
            <li><a href="">Contact</a></li>
            <li><a href="">Conditions d'utilisation</a></li>
            <li><a href="">Credits</a></li>
            <li><a href="">Paramètres de confidentialité</a></li>
        </section>
        
        <p>Le propriétaire de ce site n’est pas responsable du contenu généré par l’utilisateur (mot utiliser, messages, noms d’utilisateur)</p>
    </footer>  
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>