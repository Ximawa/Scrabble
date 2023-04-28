<?php
    require_once("cellule.php");

    class Plateau{
        public $cellules;

        public function __construct(){
            $this->cellules = array();

            $fp = fopen("plateau.txt", 'r');
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



            // foreach($lines as $i => $line){
            //     foreach($line as $j => $char){
            //         if ($char == "R"){
            //             $this->cellulles[$i][$j] = new Cellule($i, $j, "Mot compte Triple");
            //         }elseif($char == "O"){
            //             $this->cellulles[$i][$j] = new Cellule($i, $j, "Mot compte Double");
            //         }elseif($char == "B"){
            //             $this->cellulles[$i][$j] = new Cellule($i, $j, "Lettre compte Triple");
            //         }
            //         elseif($char == "G"){
            //             $this->cellulles[$i][$j] = new Cellule($i, $j, "Lettre compte Double");
            //         }elseif($char == "N"){
            //             $this->cellulles[$i][$j] = new Cellule($i, $j, " ");
            //         }
            //     }
            // }
        }
    }

?>