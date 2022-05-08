<?php

namespace App\Array\Sort;

class BaseSort
{
    protected int $depth;
    protected array $numbers;

    protected function readArray(array $array): void
    {
        $this->numbers = [];
        $this->depth = 0;
        foreach ($array as $row) {
            foreach ($row as $number) {
                $this->numbers[] = $number;
            }
            $this->depth++;
        }
        sort($this->numbers);
    }
}