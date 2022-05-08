<?php

namespace App\Array\Sort;

class Diagonal extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $matrix = [];
        $position = 0;
        $x = 0;
        $y = 0;
        $max = 0;
        $min = 0;
        do {
            $matrix[$x][$y] = $this->numbers[$position];
            $position++;
            if (($y === $max)) {
                if ($y === ($this->depth - 1)) {
                    $min++;
                } else {
                    $max++;
                }
                $x = $max;
                $y = $min;
            } else {
                $x--;
                $y++;
            }
        } while (($x < ($this->depth)) && ($y < ($this->depth)));
        return $matrix;
    }
}