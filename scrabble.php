<?php

    class Scrabble {

        // Methods
        // Constructor
        public function __construct() {
        }

        public function verifMotValide(string $mot) {
            $fichier = file_get_contents("listeMot.txt");
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