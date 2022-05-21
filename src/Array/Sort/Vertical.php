<?php

namespace App\Array\Sort;

class Vertical extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $outputArray = [];
        for ($i = 0; $i < $this->depth; $i++) {
            for ($j = 0; $j < $this->depth; $j++) {
                $outputArray[$j][$i] = array_shift($this->numbers);
            }
        }
        return $outputArray;
    }
}