<?php

namespace Tests\Unit;

use App\Helpers\Arrays\ArrayGenerator;
use PHPUnit\Framework\TestCase;

class ArrayGeneratorTest extends TestCase
{
    /**
     * @dataProvider provideDepths
     * @param int $depth
     * @return void
     */
    public function test_generator_return_array_with_correct_depth(int $depth): void
    {
        $newArray = (new ArrayGenerator($depth))->getArray();

        $countRows = count($newArray);
        $this->assertTrue(($depth === $countRows), "Incorrect number of rows. Expected: $depth but has $countRows");
        $fail = false;
        foreach ($newArray as $row) {
            if ($depth != count($row)) {
                $fail = true;
            }
        }

        $this->assertFalse($fail, "Incorrect number of elements at least in one row.");
    }

    public function provideDepths(): \Generator
    {
        for ($i = 1; $i <= 10; $i++){
            yield "Depth $i" => [$i];
        }
    }
}
