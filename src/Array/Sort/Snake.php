<?php

namespace App\Array\Sort;

class Snake extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $outputArray = [];
        for ($i = 0; $i < $this->depth; $i++) {
            if ($i % 2 === 0) {
                for ($j = 0; $j < $this->depth; $j++) {
                    $outputArray[$i][$j] = array_shift($this->numbers);
                }
            } else {
                for ($j = $this->depth - 1; $j >= 0; $j--) {
                    $outputArray[$i][$j] = array_shift($this->numbers);
                }
            }
            ksort($outputArray[$i]);
        }
        return $outputArray;
    }

}