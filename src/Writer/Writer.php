<?php

namespace App\Writer;

abstract class Writer implements WriteInterface
{
    abstract public function write(array $inputArray, array $outputArray, string $sortType): void;
}