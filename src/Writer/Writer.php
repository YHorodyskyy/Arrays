<?php

namespace App\Writer;

abstract class Writer implements OutputInterface
{
    abstract public function write(array $inputArray, array $outputArray, string $sortType): void;
}