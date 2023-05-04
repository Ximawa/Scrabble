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
                    // Check if premier mot passe par case central
                    if(count($this->motJouer) == 0){
                        if($this->passeParCentre($mot,$posX,$posY,$direction) == false){
                            return "Le premier mot doit passer par le centre";
                        }
                    }

                    // Poser mot 
                    $longueur_mot = strlen($mot);
                    if ($direction == "hori") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posY][$posX + $i]->setLettre($mot[$i]);
                            $joueur->RetirerPiece($mot[$i]);
                            
                        }
                        $this->motJouer[] = $mot;
                        return "done";
                    } elseif ($direction == "verti") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posY + $i][$posX]->setLettre($mot[$i]);
                            $joueur->RetirerPiece($mot[$i]);
                        }
                        $this->motJouer[] = $mot;
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
            
            
        }

        function passeParCentre($mot, $posX, $posY, $direction){
            // Si premiere lettre du mot est au centre pas besoin plus de verif
            if($posX == 8 && $posY == 8){
                return true;
            }

            // Si la lettre n'est ni sur la collonne et ligne centrale imposssible qu'il passe par le centre
            if($posX != 8 && $posY != 8){
                return false;
            }

            if($direction == "hori"){
                $len = strlen($mot);
                for($i=0; $i<$len; $i++){
                    $posX += $i;
                    if($posX == 8 && $posY == 8){
                        return true;
                    }
                }
            }elseif($direction == "verti"){
                $len = strlen($mot);
                for($i=0; $i<$len; $i++){
                    $posY += $i;
                    if($posX == 8 && $posY == 8){
                        return true;
                    }
                }
            }

            return false;
        }
    }        

?>