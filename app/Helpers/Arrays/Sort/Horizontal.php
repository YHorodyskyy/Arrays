<?php

namespace App\Helpers\Arrays\Sort;

class Horizontal extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $outputArray = [];
        for ($i = 0; $i < $this->depth; $i++) {
            for ($j = 0; $j < $this->depth; $j++) {
                $outputArray[$i][$j] = array_shift($this->numbers);
            }
        }
        return $outputArray;
    }
}
