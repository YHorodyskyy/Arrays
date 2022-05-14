<?php

namespace App\Array\Sort;

class Horizontal extends BaseSort
{
    public function sort(array &$array): void
    {
        $this->readArray($array);
        for ($i = 0; $i < $this->depth; $i++) {
            for ($j = 0; $j < $this->depth; $j++) {
                $array[$i][$j] = array_shift($this->numbers);
            }
        }
    }
}
