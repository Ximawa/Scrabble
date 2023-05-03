<?php
    require_once('piece.php');

    class Pioche {
        // Properties
        public $pieces;

        // Methods
        // Constructor
        public function __construct() {
            $this->pieces = array(
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('A', 1),
                new Piece('B', 3),
                new Piece('B', 3),
                new Piece('C', 3),
                new Piece('C', 3),
                new Piece('D', 2),
                new Piece('D', 2),
                new Piece('D', 2),
                new Piece('D', 2),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('E', 1),
                new Piece('F', 4),
                new Piece('F', 4),
                new Piece('G', 2),
                new Piece('G', 2),
                new Piece('G', 2),
                new Piece('H', 4),
                new Piece('H', 4),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('I', 1),
                new Piece('J', 8),
                new Piece('K', 10),
                new Piece('L', 1),
                new Piece('L', 1),
                new Piece('L', 1),
                new Piece('L', 1),
                new Piece('M', 2),
                new Piece('M', 2),
                new Piece('N', 1),
                new Piece('N', 1),
                new Piece('N', 1),
                new Piece('N', 1),
                new Piece('N', 1),
                new Piece('N', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('O', 1),
                new Piece('P', 3),
                new Piece('P', 3),
                new Piece('Q', 8),
                new Piece('R', 1),
                new Piece('R', 1),
                new Piece('R', 1),
                new Piece('R', 1),
                new Piece('R', 1),
                new Piece('R', 1),              
                new Piece('S', 1),
                new Piece('S', 1),
                new Piece('S', 1),
                new Piece('S', 1),
                new Piece('S', 1),
                new Piece('S', 1),        
                new Piece('T', 1),
                new Piece('T', 1),
                new Piece('T', 1),
                new Piece('T', 1),
                new Piece('T', 1),
                new Piece('T', 1),
                new Piece('U', 1),
                new Piece('U', 1),
                new Piece('U', 1),
                new Piece('U', 1),
                new Piece('U', 1),
                new Piece('U', 1),
                new Piece('V', 4),
                new Piece('V', 4),
                new Piece('W', 10),
                new Piece('X', 10),
                new Piece('Y', 10),
                new Piece('Z', 10),
                new Piece(' ', 0),
                new Piece(' ', 0)
            );
        }
        
        public function nombrePieces() {
            return count($this->pieces);
        }

    }


?>