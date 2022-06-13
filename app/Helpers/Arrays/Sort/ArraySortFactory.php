<?php

namespace App\Helpers\Arrays\Sort;

use App\Helpers\Arrays\Sort\ArraySortType;

class ArraySortFactory
{
    private static array $instances = [];
    private static string $nameSpace = "\App\Helpers\Arrays\Sort";

    public function getInstance(ArraySortType $sortType): SortInterface
    {
        if (!key_exists($sortType->name, static::$instances)) {
            $this->writeInstanceToCache($sortType);
        }
        return static::$instances[$sortType->name];
    }

    public function getAll(): array
    {
        foreach (ArraySortType::cases() as $sortType) {
            $this->getInstance($sortType);
        }
        return static::$instances;
    }

    private function writeInstanceToCache(ArraySortType $sortType): void
    {
        $sortClass = static::$nameSpace . "\\" . $sortType->value;
        static::$instances[$sortType->name] = new $sortClass();
    }
}
