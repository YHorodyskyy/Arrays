<?php

namespace App\Writer;

use App\DataBase\QueryBuilder;

class MysqlWriter extends Writer
{
    public function write(array $inputArray, array $outputArray, string $sortType): void
    {
        $builder = new QueryBuilder();
        $builder->table("arrays")
            ->insert([
                "sort_type" => $sortType,
                "input_array" => json_encode($inputArray),
                "output_array" => json_encode($outputArray)
            ])
            ->execute();
    }
}