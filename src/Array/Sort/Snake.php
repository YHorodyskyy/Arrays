<?php

namespace App\Array\Sort;

class Snake extends BaseSort
{
    public function sort(array $array): array
    {
        $this->readArray($array);
        $matrix = [];
        $position = 0;
        for ($i = 0; $i < $this->depth; $i++) {
            if ($i % 2 === 0) {
                for ($j = 0; $j < $this->depth; $j++) {
                    $matrix[$i][$j] = $this->numbers[$position];
                    $position++;
                }
            } else {
                for ($j = $this->depth - 1; $j >= 0; $j--) {
                    $matrix[$i][$j] = $this->numbers[$position];
                    $position++;
                }
            }
            ksort($matrix[$i]);
        }
        return $matrix;
    }

}