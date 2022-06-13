<?php

namespace Tests\Unit\Sort;

use App\Helpers\Arrays\Sort\ArraySortFactory;
use App\Helpers\Arrays\Sort\ArraySortType;
use App\Helpers\Arrays\Sort\Diagonal;
use App\Helpers\Arrays\Sort\Horizontal;
use App\Helpers\Arrays\Sort\Snail;
use App\Helpers\Arrays\Sort\Snake;
use App\Helpers\Arrays\Sort\Vertical;
use PHPUnit\Framework\TestCase;

class ArraySortFactoryTest extends TestCase
{
    /**
     * @dataProvider provideSorters
     * @param ArraySortType $sortType
     * @param string $sortClass
     * @return void
     */
    public function test_get_right_sorter(ArraySortType $sortType, string $sortClass): void
    {
        $sorter = (new ArraySortFactory())->getInstance($sortType);
        $this->assertTrue(is_a($sorter, $sortClass));
    }

    public function provideSorters(): \Generator
    {
        yield ArraySortType::Vertical->name => [
            ArraySortType::Vertical,
            Vertical::class
        ];
        yield ArraySortType::Horizontal->name => [
            ArraySortType::Horizontal,
            Horizontal::class
        ];
        yield ArraySortType::Diagonal->name => [
            ArraySortType::Diagonal,
            Diagonal::class
        ];
        yield ArraySortType::Snail->name => [
            ArraySortType::Snail,
            Snail::class
        ];
        yield ArraySortType::Snake->name => [
            ArraySortType::Snake,
            Snake::class
        ];
    }
}
