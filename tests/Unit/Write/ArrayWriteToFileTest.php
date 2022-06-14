<?php

namespace Tests\Unit\Write;

use App\Helpers\Arrays\Writers\ArrayToFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArrayWriteToFileTest extends TestCase
{
    /**
     * @dataProvider provide_data_to_write
     * @param array $inputArray
     * @param array $outputArray
     * @param string $label
     * @param string $expected
     * @return void
     */
    public function test_array_written_to_file(array $inputArray, array $outputArray, string $label, string $expected): void
    {
        $fakeDisk = "fake-disk";
        $fileName = "tmp.txt";
        Storage::fake($fakeDisk);

        $fileWriter = new ArrayToFile($fileName, $fakeDisk);
        $fileWriter->write($inputArray, $outputArray, $label);
        Storage::disk($fakeDisk)->assertExists($fileName);
        $this->assertEquals(Storage::disk($fakeDisk)->get($fileName), $expected);
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
                "Test",
                "\nInput array\n1, 2\n3, 4\nTest\n1, 2\n3, 4\n"
            ]
        ];
    }
}
