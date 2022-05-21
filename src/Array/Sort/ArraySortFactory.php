<?php

namespace App\Array\Sort;

class ArraySortFactory
{
    private static array $instances = [];
    private array $sortClasses = [
        "\App\Array\Sort\Horizontal",
        "\App\Array\Sort\Vertical",
        "\App\Array\Sort\Snake",
        "\App\Array\Sort\Diagonal",
        "\App\Array\Sort\Snail",
    ];

    public function getInstance(string $sortType): SortInterface
    {
        if (!key_exists($sortType, static::$instances)) {
            static::$instances[$sortType] = new $sortType();
        }
        return static::$instances[$sortType];
    }

    public function getAll(): array
    {
        foreach ($this->sortClasses as $className) {
            $this->getInstance($className);
        }
        return static::$instances;
    }
}
