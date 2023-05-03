<?php
    require_once('pioche.php');

    class Joueur {
        // Properties
        public $score,$nom;
        public $main;
        
        // Methods
        // Constructor
        public function __construct($nom) {
            $this->nom = $nom;
            $this->score = 0;
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

        public function RetirerPiece($lettre){
            foreach($this->main as $index => $piece) {
                if ($piece->get_lettre() == $lettre) {
                    array_splice($this->main, $index, 1);
                    break;
                }
            }
        }
    }


?>