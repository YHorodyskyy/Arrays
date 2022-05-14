<?php

namespace App\Array\Sort;

class Diagonal extends BaseSort
{
    public function sort(array &$array): void
    {
        $this->readArray($array);
        $array = [];
        $x = 0;
        $y = 0;
        $max = 0;
        $min = 0;
        do {
            $array[$x][$y] = array_shift($this->numbers);
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
    }
}