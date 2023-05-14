<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="affichage\styleHome.css" rel="stylesheet" >
    <title>Scrabble PHP</title>
</head> 
<body>
<header>
        <img src="img\Logo_Epsi_Scrabble.png" alt="logo">
        <div>
            <button>
                <a href="Page_Joueur\PageConnexion.php">Connexion</a>
            </button>
            
            
            <button>
                <a href="Page_Joueur\PageInscription.php">Creaction de compte</a>
                
            </button>
        </div>

    </header>

    <main>
        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <p>Multijoueur</p>
                <div class="row">
                    <p class="col">affichage de profil</p>

                    <form method="post" action="" class="col">
                        <input type="submit" name="Creaction de la partie" value="Creaction de la partie">
                    </form>

                    <form method="post" action="" class="col">
                        <input type="submit" name="rejoindre la partie" value="rejoindre la partie">
                    </form>
                </div>
                
            </div>
                
        </section>
        <section class="container mt-2">
            <div class="text-white bg-dark p-2 rounded">
                <p>Local</p>
                <div class="row">
                    <form method="post" action="Structure_du_jeu/game.php" class="col">
                        <input type="text" name="joueur1" placeholder="Nom joueur 1">
                    </form>
                    <form method="post" action="Structure_du_jeu/game.php"class="col">
                        <input type="text" name="joueur2" placeholder="Nom joueur 2">
                    </form>
                    <br>
                    <br>
                    
                </div>
                <div class="row">
                    <form method="post" action="Structure_du_jeu/game.php">
                         <input type="submit" name="start" value="Lancer Partie">
                    </form>
                </div>    
            </div>  
            
            
           
        
        </section>
    </main>

    <footer>
        <section class="container mt-2">
            <div class="row">
                <li class = "col"><a href="">Contact</a></li>
                <li class = "col"><a href="">Conditions d'utilisation</a></li>
                <li class = "col"><a href="">Credits</a></li>
                <li class = "col"><a href="">Paramètres de confidentialité</a></li>
            </div>
            
        </section>
        <center>
            <p>Le propriétaire de ce site n’est pas responsable du contenu généré par l’utilisateur (mot utiliser, messages, noms d’utilisateur)</p>
        </center>
        
    </footer>

</body>
</html>