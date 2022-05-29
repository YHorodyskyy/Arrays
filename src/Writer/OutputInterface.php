<?php

namespace App\Writer;

interface OutputInterface
{
    public function prepareToOutput(array $inputArray, array $outputArray, string $sortType): string;
}