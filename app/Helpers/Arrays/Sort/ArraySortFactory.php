<?php

namespace App\Helpers\Arrays\Sort;

use App\Helpers\Arrays\Sort\ArraySortType;

class ArraySortFactory
{
    private static array $instances = [];
    private static string $sortNameSpace = "\App\Helpers\Arrays\Sort";

    public function getInstance(ArraySortType $sortType): SortInterface
    {
        $sortClass = static::$sortNameSpace . "\\" . $sortType->name;
        static::$instances[$sortType->name] = new $sortClass();

        return static::$instances[$sortType->name];
    }

    public function getAll(): array
    {
        foreach (ArraySortType::cases() as $sortType) {
            $this->getInstance($sortType);
        }
        return static::$instances;
    }
}
