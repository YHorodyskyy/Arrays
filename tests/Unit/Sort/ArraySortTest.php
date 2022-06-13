<?php

namespace Tests\Unit\Sort;

use App\Helpers\Arrays\Sort\Diagonal;
use App\Helpers\Arrays\Sort\Horizontal;
use App\Helpers\Arrays\Sort\Snail;
use App\Helpers\Arrays\Sort\Snake;
use App\Helpers\Arrays\Sort\Vertical;
use PHPUnit\Framework\TestCase;

class ArraySortTest extends TestCase
{
    /**
     * @dataProvider provideSortedArrays
     * @param array $inputArray
     * @param array $validArray
     * @param $sorter
     * @return void
     */
    public function test_sorter_result(array $inputArray, array $validArray, $sorter): void
    {
        $testArray = $sorter->sort($inputArray);
        $this->assertTrue($validArray === $testArray);
    }

    public function provideSortedArrays(): \Generator
    {
        yield "Vertical sorter" => [
            [
                [2, 12, 3, 4],
                [8, 10, 9, 1],
                [7, 16, 6, 13],
                [14, 15, 5, 11]
            ],
            [
                [1, 5, 9, 13],
                [2, 6, 10, 14],
                [3, 7, 11, 15],
                [4, 8, 12, 16]
            ],
            (new Vertical())
        ];
        yield "Horizontal sorter" => [
            [
                [2, 12, 3, 4],
                [8, 10, 9, 1],
                [7, 16, 6, 13],
                [14, 15, 5, 11]
            ],
            [
                [1, 2, 3, 4],
                [5, 6, 7, 8],
                [9, 10, 11, 12],
                [13, 14, 15, 16]
            ],
            (new Horizontal())
        ];
        yield "Diagonal sorter" => [
            [
                [2, 12, 3, 4],
                [8, 10, 9, 1],
                [7, 16, 6, 13],
                [14, 15, 5, 11]
            ],
            [
                [1, 3, 6, 10],
                [2, 5, 9, 13],
                [4, 8, 12, 15],
                [7, 11, 14, 16]
            ],
            (new Diagonal())
        ];
        yield "Snake sorter" => [
            [
                [2, 12, 3, 4],
                [8, 10, 9, 1],
                [7, 16, 6, 13],
                [14, 15, 5, 11]
            ],
            [
                [1, 2, 3, 4],
                [8, 7, 6, 5],
                [9, 10, 11, 12],
                [16, 15, 14, 13]
            ],
            (new Snake())
        ];
        yield "Snail sorter" => [
            [
                [2, 12, 3, 4],
                [8, 10, 9, 1],
                [7, 16, 6, 13],
                [14, 15, 5, 11]
            ],
            [
                [1, 2, 3, 4],
                [12, 13, 14, 5],
                [11, 16, 15, 6],
                [10, 9, 8, 7]
            ],
            (new Snail())
        ];
    }
}
