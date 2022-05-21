<?php

namespace App\Writer;

interface OutputInterface
{
    public function write(array $inputArray, array $outputArray, string $sortType): void;
}