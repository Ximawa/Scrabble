<!DOCTYPE html>
<html lang="en">
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
                <h1><img src="img\Logo_Epsi_Scrabble.png" alt="LOGO du jeu">Scrabble</h1>
        </section>      
    </header>
    <form method="post" action="Structure_du_jeu/game.php">
        <input type="text" name="joueur1" placeholder="Nom joueur 1">
        <br>
        <br>
        <input type="text" name="joueur2" placeholder="Nom joueur 2">
        <br>
        <br>
        <input type="submit" name="start" value="Lancer Partie">
    </form>
</body>
</html>