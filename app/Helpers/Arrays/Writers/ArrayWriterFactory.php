<?php

namespace App\Helpers\Arrays\Writers;

class ArrayWriterFactory
{
    private static array $instances = [];
    private static string $nameSpace = "\App\Helpers\Arrays\Writers";

    public function getInstance(ArrayWriterType $writerType): WriteInterface
    {
        if (!key_exists($writerType->name, static::$instances)) {
            $this->writeInstanceToCache($writerType);
        }
        return static::$instances[$writerType->name];
    }

    public function getAll(): array
    {
        foreach (ArrayWriterType::cases() as $writerType) {
            $this->getInstance($writerType);
        }
        return static::$instances;
    }

    private function writeInstanceToCache(ArrayWriterType $writerType): void
    {
        $sortClass = static::$nameSpace . "\\" . $writerType->value;
        static::$instances[$writerType->name] = new $sortClass();
    }

}
