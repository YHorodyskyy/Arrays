<?php

namespace App\Helpers\Arrays\Writers;

use App\Models\ArraySort;

class MysqlWriter extends Writer
{
    public function write(array $inputArray, array $outputArray, string $sortType): void
    {
        ArraySort::create([
            "input_array" => json_encode($inputArray),
            "output_array" => json_encode($outputArray),
            "sort_type" => $sortType,
        ]);
    }
}
