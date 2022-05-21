<?php

namespace App\Array\Sort;

class Snail extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $outputArray = $this->fillArray();
        ksort($outputArray);
        foreach ($outputArray as $key => $value){
            ksort($outputArray[$key]);
        }
        return $outputArray;
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