<?php
    require_once('cellule.php');

    class Plateau{
        public $cellules;

        public function __construct(){
            $this->cellules = array();

            $handle = fopen("plateau.txt", "r");
            if ($handle) {
                $countLine = 1;
                while (($line = fgets($handle)) !== false) {
                    $this->cellules[$countLine] = array();
                    $chars = str_split(trim($line));
                    $countChar = 1;
                    foreach ($chars as $char) {
                        switch ($char) {
                            case 'R':
                                $bonus = "motTriple";
                                break;
                            case 'O':
                                $bonus = "motDouble";
                                break;
                            case 'B':
                                $bonus = "lettreTriple";
                                break;
                            case 'G':
                                $bonus = "lettreDouble";
                                break;
                            default:
                                $bonus = "normal";
                        }
                        $this->cellules[$countLine][$countChar] = new Cellule($countLine, $countChar, $bonus);
                        $countChar++;
                    }
                    $countLine++;
                }
                fclose($handle);
            }
        }

        public function getCellules($posX, $posY){
            return $this->cellules[$posX][$posY];
        }
    }

?>