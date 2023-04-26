<?php
    class Piece {
        // Properties
        public $lettre, $valeur;

        // Methods
        // Constructor
        public function __construct($lettre, $valeur){
            $this->lettre = $lettre;
            $this->valeur = $valeur;
        }

        // Setters
        function get_lettre(){
            return $this->lettre;
        }
        function get_valeur(){
            return $this->valeur;
        }
    }

?>