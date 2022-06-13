<?php

namespace Tests\Unit\Write;

use App\Helpers\Arrays\Writers\ArrayToFile;
use App\Helpers\Arrays\Writers\DownloadInterface;
use App\Helpers\Arrays\Writers\MysqlWriter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArrayWriteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider provide_data_to_write
     * @param array $inputArray
     * @param array $outputArray
     * @param string $label
     * @return void
     */
    public function test_array_written_to_file(array $inputArray, array $outputArray, string $label): void
    {
        $fakeDisk = "fake-disk";
        $fileName = "tmp.txt";
        Storage::fake($fakeDisk);

        $fileWriter = new ArrayToFile($fileName, $fakeDisk);
        $fileWriter->write($inputArray, $outputArray, $label);
        Storage::disk($fakeDisk)->assertExists($fileName);
    }

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
