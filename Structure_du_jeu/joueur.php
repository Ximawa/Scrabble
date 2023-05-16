<?php
    require_once('pioche.php');

    class Joueur {
        // Properties
        public $score,$nom,$nbMotJouer;
        public $main;
        
        // Methods
        // Constructor
        public function __construct($nom) {
            $this->nom = $nom;
            $this->score = 0;
            $this->nbMotJouer = 0;
            $this->main = array();
        }

        public function PiocheDebutPartie($pioche){
            for ($i = 0; $i < 7; $i++) {
                $index = rand(0, count($pioche->pieces) - 1);
                $piece = $pioche->pieces[$index];
                array_splice($pioche->pieces, $index, 1);
                $this->main[] = $piece;
            }
        }

        public function Piocher($pioche){
            $nbCarteMain = count($this->main);
            for($i = $nbCarteMain; $i < 7; $i++) {
                $index = rand(0, count($pioche->pieces) - 1);
                $piece = $pioche->pieces[$index];
                array_splice($pioche->pieces, $index, 1);
                $this->main[] = $piece;
            }
        }

        public function RetirerPiece($mot){
            $lettres = str_split($mot);
            foreach($lettres as $lettre){
                foreach($this->main as $index => $piece) {
                    if ($piece->get_lettre() == $lettre) {
                        array_splice($this->main, $index, 1);
                        break;
                    }
                }
            }
        }

        public function AjouterScore($mot, $bonus){
            if(strlen($mot) == 7){
                $this->score += 50;
            }
            $pointGagne = 0;
            $lettres = str_split($mot);
            $motCompteTriple = false;
            $motCompteDouble = false;           
            foreach ($lettres as $lettre) {
                foreach ($this->main as $index => $piece) {
                    if ($piece->get_lettre() == $lettre) {
                        $valeur = $piece->get_valeur();
                        if (isset($bonus[$lettre])) {
                            var_dump($bonus[$lettre]);
                            $typeBonus = $bonus[$lettre];
                            switch ($typeBonus) {
                                case "normal":
                                    break; 
                                case "lettreTriple":
                                    $valeur *= 3; 
                                    break;
                                case "lettreDouble":
                                    $valeur *= 2; 
                                    break;
                                case "motTriple":
                                    $motCompteTriple = true;
                                    break;
                                case "motDouble":
                                    $motCompteDouble = true;
                                    break;
                                default:
                                    break; 
                            }
                        }
        
                        $pointGagne += $valeur;
                    }
                }
            }
            
            // Appliquer les bonus mot compte triple et mot compte double
            if ($motCompteTriple) {
                $pointGagne *= 3;
            }
            
            if ($motCompteDouble) {
                $pointGagne *= 2;
            }

            var_dump($pointGagne);
            $this->score += $pointGagne;
        }

        public function changerLettre($pioche){
            $pioche->pieces = array_merge($pioche->pieces, $this->main);

            $this->main = array();

            for ($i = 0; $i < 7; $i++) {
                $index = rand(0, count($pioche->pieces) - 1);
                $piece = $pioche->pieces[$index];
                array_splice($pioche->pieces, $index, 1);
                $this->main[] = $piece;
            }
        }
    }


?>