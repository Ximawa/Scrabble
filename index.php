<?php 
    require_once("piece.php");
?>

<html>
<head>
<title>PHP Test</title>
</head>
<body>
    <?php
        $A = new Piece("Z", 10);

        echo $A->get_lettre();
    ?>
</body>
</html>