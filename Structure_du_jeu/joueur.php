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

        public function AjouterScore($mot){
            $lettres = str_split($mot);
            foreach($lettres as $lettre ){
                foreach($this->main as $index => $piece) {
                    if ($piece->get_lettre() == $lettre) {
                        $this->score += $piece->get_valeur();
                    }
                }
            }
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