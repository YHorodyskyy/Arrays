<?php

namespace Tests\Unit\Write;

use App\Helpers\Arrays\Writers\MysqlWriter;
use App\Models\ArraySort;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArrayWriteToMysqlTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider provide_data_to_write
     * @param array $inputArray
     * @param array $outputArray
     * @param string $label
     * @return void
     */
    public function test_array_write_to_db(array $inputArray, array $outputArray, string $label): void
    {
        $this->assertDatabaseCount('arrays', 0);

        (new MysqlWriter())->write($inputArray, $outputArray, $label);

        $this->assertDatabaseCount('arrays', 1);

        $record = ArraySort::first();
        $this->assertEquals($record->sort_type,$label);
        $this->assertJsonStringEqualsJsonString($record->input_array,json_encode($inputArray));
        $this->assertJsonStringEqualsJsonString($record->output_array,json_encode($outputArray));
    }

    public function provide_data_to_write(): array
    {
        return [
            [
                [
                    [1, 2],
                    [3, 4],
                ],
                [
                    [1, 2],
                    [3, 4],
                ],
                "Test"
            ]
        ];
    }
}
