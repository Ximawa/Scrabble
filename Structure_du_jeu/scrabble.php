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
            $mot = strtoupper($mot);
            // Check mot compose de la main
            if($this->verifMotComposition($mot, $joueur->main) == true) {
                // Check if mot valide dictionnaire
                if($this->verifMotValide($mot)){
                    // Check if premier mot passe par case central
                    if(count($this->motJouer) == 0){
                        if($this->passeParCentre($mot,$posY,$posX,$direction) == false){
                            echo "Le premier mot doit passer par le centre";
                            return false;
                        }
                        $motComplet = $mot;
                    }else{
                        if($this->emplaceMotDisponible($mot,  $posY, $posX, $direction) == false){
                            echo "Vous ne pouvez pas poser un mot par dessus un mot existant";
                            return false;
                        }elseif($this->Adjacent($mot, $posY, $posX, $direction) == false){
                            echo "Les mots doivent être adjacent a un mot existant";
                            return false;
                        }
                        $motComplet = $this->obtenirMotComplet($mot, $posY, $posX, $direction);
                        if($this->verifMotValide($motComplet) == false){
                            echo "Vous devez completez avec des mots valide";
                            return false;
                        }      
                    }
                    // Poser mot 
                    $longueur_mot = strlen($mot);
                    var_dump($longueur_mot);
                    $bonus = array();
                    if ($direction == "hori") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posX][$posY + $i]->setLettre($mot[$i]);
                            $bonus[$this->plateau->cellules[$posX][$posY + $i]->getLettre()] = $this->plateau->cellules[$posX][$posY + $i]->getBonus();
                        }
                        $joueur->AjouterScore($motComplet, $bonus);
                        $joueur->RetirerPiece($mot); 
                        $this->motJouer[] = $mot;
                        $joueur->nbMotJouer += 1;
                        $joueur->Piocher($pioche);
                        return true;
                    } elseif ($direction == "verti") {
                        for ($i = 0; $i < $longueur_mot; $i++) {
                            $this->plateau->cellules[$posX + $i][$posY]->setLettre($mot[$i]);
                            $bonus[$this->plateau->cellules[$posX][$posY + $i]->getLettre()] = $this->plateau->cellules[$posX][$posY + $i]->getBonus();
                        }
                        $joueur->AjouterScore($motComplet , $bonus);
                        $joueur->RetirerPiece($mot);
                        $this->motJouer[] = $mot;
                        $joueur->nbMotJouer += 1;
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

        // function Adjacent($mot, $posX, $posY, $direction){
        //     if($direction == "hori"){
        //         if($this->plateau->getCellules($posX - 1, $posY)->getLettre() != "" || $this->plateau->getCellules($posX, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($posX, $posY + 1)->getLettre() != ""){
        //             return true; 
        //         }
        //         $len = strlen($mot) - 1;
        //         for($i=$posX + 1; $i<($len + $posX); $i++){
        //             if($this->plateau->getCellules($i, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($i, $posY + 1)->getLettre() != ""){
        //                 return true;
        //             }
        //         }
        //         if($this->plateau->getCellules($posX + $len, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($posX + $len + 1, $posY)->getLettre() != "" || $this->plateau->getCellules($posX + $len, $posY + 1)->getLettre() != ""){
        //             return true; 
        //         }
        //     }elseif($direction == "verti"){
        //         if($this->plateau->getCellules($posX - 1, $posY)->getLettre() != "" || $this->plateau->getCellules($posX, $posY - 1)->getLettre() != "" || $this->plateau->getCellules($posX  + 1, $posY)->getLettre() != ""){
        //             return true; 
        //         }
        //         $len = strlen($mot) - 1;
        //         for($i=$posX + 1; $i<($len + $posX); $i++){
        //             if( $this->plateau->getCellules($i - 1, $posY)->getLettre() != "" || $this->plateau->getCellules($i + 1, $posY)->getLettre() != ""){
        //                 return true;
        //             }
        //         }
        //         if($this->plateau->getCellules($posX - 1 , $posY + $len)->getLettre() != "" || $this->plateau->getCellules($posX, $posY + $len + 1)->getLettre() != "" || $this->plateau->getCellules($posX + 1, $posY + $len)->getLettre() != ""){
        //             return true; 
        //         }
        //     }

        //     return false;
        // }

        function Adjacent($mot, $posX, $posY, $direction){
            $len = strlen($mot);
            $cases = array();
            $motExist = false;

            if($direction == "hori") {
                // Recherche d'un mot existant dans la même ligne
                for($i = $posX - 1; $i <= $posX + $len; $i++) {
                    if($i >= 1 && $i < 15 && $this->plateau->getCellules($posY,$i)->getLettre() != "") {
                        $motExist = true;
                        break;
                    }
                }
                
                // Recherche des cases utilisées par le mot
                for($i = $posX; $i < $posX + $len; $i++) {
                    if($i >= 0 && $i < 15) {
                        $cases[] = array($i, $posY);
                    }
                }
            } else {
                // Recherche d'un mot existant dans la même colonne
                for($i = $posY - 1; $i <= $posY + $len; $i++) {
                    if($i >= 1 && $i < 15 && $this->plateau->getCellules($i , $posX)->getLettre() != "") {
                        $motExist = true;
                        break;
                    }
                }

                // Recherche des cases utilisées par le mot
                for($i = $posY; $i < $posY + $len; $i++) {
                    if($i >= 0 && $i < 15) {
                        $cases[] = array($posX, $i);
                    }
                }
            }

            // Vérification des cases adjacentes
            foreach($cases as $case) {
                $x = $case[0];
                $y = $case[1];
                
                if($x > 1 && $this->plateau->getCellules($y, $x - 1)->getLettre() != "") {
                    return true;
                }
                
                if($x < 14 && $this->plateau->getCellules($y, $x + 1)->getLettre() != "") {
                    return true;
                }
                
                if($y > 1 && $this->plateau->getCellules($y - 1, $x)->getLettre() != "") {
                    return true;
                }
                
                if($y < 14 && $this->plateau->getCellules($y + 1, $x)->getLettre() != "") {
                    return true;
                }
            }
            
            // Retourne false si aucun mot adjacent n'a été trouvé
            return $motExist;
        }

    //     function emplaceMotDisponible($mot, $posX, $posY, $direction){
    //         if($direction == "hori"){
    //             $len = strlen($mot);
    //             for($i=$posX; $i<($len + $posX); $i++){
    //                 if($this->plateau->getCellules($i, $posY)->getLettre() != ""){
    //                     return false;
    //                 }
    //             }
    //         }elseif($direction == "verti"){
    //             $len = strlen($mot);
    //             for($i=$posY; $i<($len + $posY); $i++){
    //                 if($this->plateau->getCellules($posX, $i)->getLettre() != ""){
    //                     return false;
    //                 }
    //             }
    //         }
    //         return true;
    //     }
    // }        
    
    function emplaceMotDisponible($mot, $posX, $posY, $direction) {
        $len = strlen($mot);
        $cases = array();
        $dispo = true;
        
        // Recherche des cases utilisées par le mot
        if($direction == "hori") {
            
            for($i = $posX; $i < $posX + $len; $i++) {
                
                if($i >= 0 && $i <= 15 && $this->plateau->getCellules($posY, $i)->getLettre() == "") {
                    $cases[] = array($i, $posY);
                } else {
                    $dispo = false;
                }
            }
        } else {
            for($i = $posY; $i < $posY + $len; $i++) {
                if($i >= 0 && $i <= 15 && $this->plateau->getCellules($i, $posX)->getLettre() == "") {
                    $cases[] = array($posX, $i);
                } else {
                    $dispo = false;
                }
            }
        }
        
        // Retourne les cases utilisées par le mot si elles sont toutes vides
        return $dispo;
        }
    

    function obtenirMotComplet($mot, $posX, $posY, $direction) {
        $len = strlen($mot);
        $motComplet = "";
        
        // Obtention du mot complet dans la même ligne ou colonne
        if ($direction == "hori") {
            // Recherche vers la gauche
            $x = $posX - 1;
            while ($x >= 0 && $this->plateau->getCellules($posY,$x)->getLettre() !== "") {
                $motComplet = $this->plateau->getCellules($posY,$x)->getLettre() . $motComplet;
                $x--;
            }
            
            // Ajout du mot en cours
            $motComplet .= $mot;
            
            // Recherche vers la droite
            $x = $posX + $len;
            while ($x < 15 && $this->plateau->getCellules($posY,$x)->getLettre() !== "") {
                $motComplet .= $this->plateau->getCellules($posY, $x)->getLettre();
                $x++;
            }
        } else {
            // Recherche vers le haut
            $y = $posY - 1;
            while ($y >= 0 && $this->plateau->getCellules($y, $posX)->getLettre() !== "") {
                $motComplet = $this->plateau->getCellules($y, $posX)->getLettre() . $motComplet;
                $y--;
            }
            
            // Ajout du mot en cours
            $motComplet .= $mot;
            
            // Recherche vers le bas
            $y = $posY + $len;
            while ($y < 15 && $this->plateau->getCellules($y, $posX)->getLettre() !== "") {
                $motComplet .= $this->plateau->getCellules($y, $posX)->getLettre();
                $y++;
            }
        }        
        return $motComplet;
    }
}

?>