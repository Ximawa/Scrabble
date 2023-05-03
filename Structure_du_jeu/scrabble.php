<?php
    require_once('plateau.php');

    class Scrabble {

        public $plateau;
        public $motJouer;
        // Methods
        // Constructor
        public function __construct() {
            $this->plateau = new Plateau();
            $this->motJouer = array();
        }

        public function verifMotValide(string $mot) {
            $fichier = file_get_contents('listeMot.txt');
            return strpos($fichier, $mot) !== false;
        }

        function verifMotComposition($mot, $main) {
            $lettresMain = array_map(function($lettre) { return $lettre->lettre; }, $main);
            $lettresMot = str_split($mot);
            foreach($lettresMot as $lettre) {
                if(!in_array($lettre, $lettresMain)) {
                    return false;
                }
            }
            return true;
        }

        function poserMot($mot, $joueur, $direction, $posX, $posY){
            // Check mot compose de la main
            if($this->verifMotComposition($mot, $joueur->main) == true) {
                // Check if mot valide dictionnaire
                if($this->verifMotValide($mot)){
                    // Poser mot -- Rajouter verif si position Libre
                    $longueur_mot = strlen($mot);
                    if ($direction == "hori") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posY][$posX + $i]->setLettre($mot[$i]);
                            $joueur->RetirerPiece($mot[$i]);
                        }
                        return "done";
                    } elseif ($direction == "verti") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posY + $i][$posX]->setLettre($mot[$i]);
                            $joueur->RetirerPiece($mot[$i]);
                        }
                        return "done";
                    } else {
                        return "Direction invalide";
                    }
                } else {
                    return "Mot non valide";
                }
            } else {
                return "Mot pas composé de la main";
            }
            

            // poser mot sur plateau
        }
    }        

?>