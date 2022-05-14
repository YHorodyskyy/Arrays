<?php

namespace App\Array\Sort;

class Snail extends BaseSort
{
    public function sort(array &$array): void
    {
        $this->readArray($array);
        $array = $this->fillArray();
        ksort($array);
        foreach ($array as $key => $value){
            ksort($array[$key]);
        }
    }

    protected function fillArray(): array
    {
        $matrix = [];
        $numElems = count($this->numbers);
        $arrayXY = [0,-1];
        $direction = 0;
        for($i=0;$i<$numElems;$i++){
            $checkXY = $arrayXY;
            switch($direction%4){
                case 0:
                    $checkXY[1]++;
                    break;
                case 1:
                    $checkXY[0]++;
                    break;
                case 2:
                    $checkXY[1]--;
                    break;
                case 3:
                    $checkXY[0]--;
                    break;
            }
            if($checkXY[0]>=$this->depth || $checkXY[1]>=$this->depth || $checkXY[0]<0 || $checkXY[1]<0 || isset($matrix[$checkXY[0]][$checkXY[1]])){
                $direction++;
                $i--;
                continue;
            }
            $arrayXY = $checkXY;
            $matrix[$checkXY[0]][$checkXY[1]] = array_shift($this->numbers);
        }
        return $matrix;
    }
}