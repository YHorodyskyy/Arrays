<?php

namespace App\Helpers\Arrays\Writers;

class ArrayWriterFactory
{
    private static array $instances = [];
    private array $writeClasses = [
        "\App\Helpers\Arrays\Writers\FileWriter",
        "\App\Helpers\Arrays\Writers\MysqlWriter",
    ];

    public function getInstance(string $writerClass): WriteInterface
    {
        if (!key_exists($writerClass, static::$instances)) {
            static::$instances[$writerClass] = new $writerClass();
        }
        return static::$instances[$writerClass];
    }

    public function getAll(): array
    {
        foreach ($this->writeClasses as $className) {
            $this->getInstance($className);
        }
        return static::$instances;
    }
}
