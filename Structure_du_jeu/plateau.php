<?php
    require_once('Structure_du_jeu/cellule.php');

    class Plateau{
        public $cellules;

        public function __construct(){
            $this->cellules = array();

            $fp = fopen('Structure_du_jeu/plateau.txt', 'r');
            $countLine = 0;
            $countChar = 0;

            while(!feof($fp)){
                $line = fgets($fp, 17);
                $chars = str_split($line);
                foreach($chars as $char){
                    if ($char == "R"){
                            $this->cellules[$countLine][$countChar] = new Cellule($countLine, $countChar, "Mot compte Triple");
                        }elseif($char == "O"){
                            $this->cellules[$countLine][$countChar] = new Cellule($countLine, $countChar, "Mot compte Double");
                        }elseif($char == "B"){
                            $this->cellules[$countLine][$countChar] = new Cellule($countLine, $countChar, "Lettre compte Triple");
                        }
                        elseif($char == "G"){
                            $this->cellules[$countLine][$countChar] = new Cellule($countLine, $countChar, "Lettre compte Double");
                        }elseif($char == "N"){
                            $this->cellules[$countLine][$countChar] = new Cellule($countLine, $countChar, " ");
                        }
                        $countChar++;
                }
                $countChar = 0;
                $countLine += 1;
            }

        }
    }

?>