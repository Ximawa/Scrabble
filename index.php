<?php
    session_start();

    if(isset($_POST['deco'])){
        // Suppression des informations en session
        session_unset();
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="affichage\styleHome.css" rel="stylesheet">
    <title>Scrabble PHP</title>
</head>

<body>
    <header>
        <div class="space">
            <div class="contenerLogo">
                <a href="./index.php">
                    <section>
                        <img class="logo" src="img\Logo_Epsi_Scrabble.png" alt="logo">
                    </section>
                </a>
                
            </div>
            <div class="space2">
            <?php 
                if(isset($_SESSION['id_utilisateur']) && isset($_SESSION['nom_utilisateur'])){
                    echo '<div> Connecte en tant que '.$_SESSION['nom_utilisateur'].'</div>';
            ?>
                    <form method="post" action="Page_Joueur/StatJoueur.php" class="col">
                        <input type="submit" name="profil" value="Voir profil"
                                class="btn btn-primary">
                    </form>
                    <form method="post" action="" class="col">
                        <input type="submit" name="deco" value="Deconnexion"
                                class="btn btn-primary">
                    </form>
            <?php
                }else{
            ?>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="Page_Joueur\PageConnexion.php" class="btn btn-primary">Connexion</a>
                </div>
                <div class="btn-group me-2" role="group" aria-label="Second group">
                    <a href="Page_Joueur\PageInscription.php" class="btn btn-primary">Creation de compte</a>
                    </div></div>
            </div>
            <?php } ?>
                
        </div>

    </header>

    <main>

        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <p>Entrez le nom des joueurs</p>
                <div class="row">
                    <form method="post" action="Structure_du_jeu/game.php" class="col" class="form-label">
                        <?php if ( isset($_SESSION['id_utilisateur'])){
                            echo '<input type="text" name="joueur1" value='.$_SESSION['nom_utilisateur'].' readonly>';
                        } else { ?>
                        <input type="text" name="joueur1" placeholder="Nom joueur 1">
                        <?php } ?>
                        <input type="text" name="joueur2" placeholder="Nom joueur 2">
                    <br>
                    <br>
                </div>
                <div class="row">
                    <div class="taille">
                        <input type="submit" name="start" value="Lancer Partie" class="btn btn-primary">
                    </form>
                    </div>
                        
                </div>
            </div>
        </section>
        <br>
        <br>

     
    </main>

    <footer>
        <section class="container mt-2">
            <div class="row">
                <li class="col"><a href="">Contact</a></li>
                <li class="col"><a href="">Conditions d'utilisation</a></li>
                <li class="col"><a href="">Credits</a></li>
                <li class="col"><a href="">Paramètres de confidentialité</a></li>
            </div>

        </section>
        <center>
            <p>Le propriétaire de ce site n’est pas responsable du contenu généré par l’utilisateur (mot utiliser,
                messages, noms d’utilisateur)</p>
        </center>

    </footer>

</body>

</html>