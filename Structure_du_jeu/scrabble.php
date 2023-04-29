<?php

    class Scrabble {

        // Methods
        // Constructor
        public function __construct() {
        }

        public function verifMotValide(string $mot) {
            $fichier = file_get_contents('Structure_du_jeu\listeMot.txt');
            return strpos($fichier, $mot) !== false;
        }

        public function verifMotComposition(string $mot , $main) {
            foreach ($main as $piece){
                if(!str_contains($mot, $piece->lettre)){
                    return false;
                }
            }
            return true;
        }
    }

?>