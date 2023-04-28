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
    }        

?>