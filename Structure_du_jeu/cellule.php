<?php
    class Cellule {
        private $posX, $posY;
        private $bonus;
        private $lettre;

        public function __construct($posX, $posY, $bonus) {
            $this->posX = $posX;
            $this->posY = $posY;
            $this->bonus = $bonus;
            $this->lettre = "";
        }

        public function getPos() {
            return $this->posX."/".$this->posY;
        }

        public function getPosX() {
            return $this->posX;
        }
        public function getPosY() {
            return $this->posY;
        }
        public function getBonus() {
            return $this->bonus;
        }
        public function getLettre(){
            return $this->lettre;
        }

        public function setPosX($posX) {
            $this->posX = $posX;
        }
        public function setPosY($posY) {
            $this->posY = $posY;
        }
        public function setBonus($bonus) {
            $this->bonus = $bonus;
        }
        public function setLettre($lettre){
            $this->lettre = $lettre;
        }
    }

?>