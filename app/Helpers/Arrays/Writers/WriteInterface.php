<?php

namespace App\Helpers\Arrays\Writers;

interface WriteInterface
{
    public function write(array $inputArray, array $outputArray, string $sortType): void;
}
