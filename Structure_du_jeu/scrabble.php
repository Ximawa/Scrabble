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

        function poserMot($mot, $joueur, $direction, $posX, $posY, $pioche){
            // Check mot compose de la main
            if($this->verifMotComposition($mot, $joueur->main) == true) {
                // Check if mot valide dictionnaire
                if($this->verifMotValide($mot)){
                    // Check if premier mot passe par case central
                    if(count($this->motJouer) == 0){
                        if($this->passeParCentre($mot,$posX,$posY,$direction) == false){
                            echo "Le premier mot doit passer par le centre";
                            return false;
                        }
                    }else{
                        if($this->Adjacent($mot, $posX, $posY, $direction) == false){
                            echo "Les mots doivent être adjacent a un mot existant";
                            return false;
                        }
                        if($this->emplaceMotDisponible($mot, $posX, $posY, $direction) == false){
                            echo "Vous ne pouvez pas poser un mot par dessus un mot existant";
                            return false;
                        }
                    }
                    // Poser mot 
                    $longueur_mot = strlen($mot);
                    if ($direction == "hori") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posY][$posX + $i]->setLettre($mot[$i]);
                            $joueur->AjouterScore($mot[$i]);
                            $joueur->RetirerPiece($mot[$i]);     
                        }
                        $this->motJouer[] = $mot;
                        $joueur->Piocher($pioche);
                        return true;
                    } elseif ($direction == "verti") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posY + $i][$posX]->setLettre($mot[$i]);
                            $joueur->AjouterScore($mot[$i]);
                            $joueur->RetirerPiece($mot[$i]);
                        }
                        $this->motJouer[] = $mot;
                        $joueur->Piocher($pioche);
                        return true;
                    }
                } else {
                    echo "Mot non valide";
                    return false;
                }
            } else {
                echo "Mot pas composé de la main";
                return false;
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
                for($i=$posX; $i<($len + $posX); $i++){
                    if($i == 8 && $posY == 8){
                        return true;
                    }
                }
            }elseif($direction == "verti"){
                $len = strlen($mot);
                for($i=$posY; $i<($len + $posY); $i++){
                    if($posX == 8 && $i== 8){
                        return true;
                    }
                }
            }

            return false;
        }

        function Adjacent($mot, $posX, $posY, $direction){
            if($direction == "hori"){
                if($this->plateau->getCellules($posX - 1, $posY)->getLettre() != "" || $this->plateau->getCellules($posX, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($posX, $posY + 1)->getLettre() != ""){
                    return true; 
                }
                $len = strlen($mot) - 1;
                for($i=$posX + 1; $i<($len + $posX); $i++){
                    if($this->plateau->getCellules($i, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($i, $posY + 1)->getLettre() != ""){
                        return true;
                    }
                }
                if($this->plateau->getCellules($posX + $len, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($posX + $len + 1, $posY)->getLettre() != "" || $this->plateau->getCellules($posX + $len, $posY + 1)->getLettre() != ""){
                    return true; 
                }
            }elseif($direction == "verti"){
                if($this->plateau->getCellules($posX - 1, $posY)->getLettre() != "" || $this->plateau->getCellules($posX, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($posX  + 1, $posY)->getLettre() != ""){
                    return true; 
                }
                $len = strlen($mot) - 1;
                for($i=$posX + 1; $i<($len + $posX); $i++){
                    if( $this->plateau->getCellules($i - 1, $posY)->getLettre() != "" || $this->plateau->getCellules($i + 1, $posY)->getLettre() != ""){
                        return true;
                    }
                }
                if($this->plateau->getCellules($posX - 1 , $posY + $len)->getLettre() != "" || $this->plateau->getCellules($posX, $posY + $len + 1)->getLettre() != "" || $this->plateau->getCellules($posX + 1, $posY + $len)->getLettre() != ""){
                    return true; 
                }
            }

            return false;
        }

        function emplaceMotDisponible($mot, $posX, $posY, $direction){
            if($direction == "hori"){
                $len = strlen($mot);
                for($i=$posX; $i<($len + $posX); $i++){
                    if($this->plateau->getCellules($i, $posY)->getLettre() != ""){
                        return false;
                    }
                }
            }elseif($direction == "verti"){
                $len = strlen($mot);
                for($i=$posY; $i<($len + $posY); $i++){
                    if($this->plateau->getCellules($posX, $i)->getLettre() != ""){
                        return false;
                    }
                }
            }
            return true;
        }
    }        

?>