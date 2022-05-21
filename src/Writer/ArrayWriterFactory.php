<?php

namespace App\Writer;

class ArrayWriterFactory
{
    private static array $instances = [];
    private array $writeClasses = [
        "\App\Writer\FileWriter",
        "\App\Writer\PageWriter",
        "\App\Writer\MysqlWriter",
    ];

    public function getInstance(string $writerClass): OutputInterface
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