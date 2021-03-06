<?php

namespace App\Helpers\Arrays;

class ArrayGenerator
{
    private int $depth;

    public function __construct(int $depth = 0)
    {
        $this->depth = ($depth ?: rand(3, 6));
    }

    public function getArray(): array
    {
        $array = [];
        $numbers = $this->getNumbers();
        $i = 0;
        for ($row = 0; $row < $this->depth; $row++) {
            for ($column = 0; $column < $this->depth; $column++) {
                $array[$row][$column] = $numbers[$i++];
            }
        }
        return $array;
    }

    private function getNumbers(): array
    {
        $source = range(1, $this->depth ** 2);
        shuffle($source);
        return $source;
    }
}
