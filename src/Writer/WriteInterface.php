<?php

namespace App\Writer;

interface WriteInterface
{
    public function write(array $inputArray, array $outputArray, string $sortType): void;
}