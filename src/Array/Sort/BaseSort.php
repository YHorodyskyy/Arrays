<?php

namespace App\Array\Sort;

abstract class BaseSort implements SortInterface
{
    protected int $depth;
    protected array $numbers;

    abstract public function sort(array &$array): void;

    protected function readArray(array $array): void
    {
        $this->numbers = [];
        $this->depth = 0;
        foreach ($array as $row) {
            $this->numbers = array_merge($this->numbers, $row);
            $this->depth++;
        }
        sort($this->numbers);
    }
}