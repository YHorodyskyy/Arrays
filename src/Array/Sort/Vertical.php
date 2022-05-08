<?php

namespace App\Array\Sort;

class Vertical extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $matrix = [];
        $position = 0;
        for ($i = 0; $i < $this->depth; $i++) {
            for ($j = 0; $j < $this->depth; $j++) {
                $matrix[$j][$i] = $this->numbers[$position];
                $position++;
            }
        }
        return $matrix;
    }
}