<?php

namespace Tests\Unit\Write;

use App\Helpers\Arrays\Writers\ArrayToFile;
use App\Helpers\Arrays\Writers\ArrayWriterFactory;
use App\Helpers\Arrays\Writers\ArrayWriterType;
use App\Helpers\Arrays\Writers\MysqlWriter;
use Tests\TestCase;

class ArrayWriterFactoryTest extends TestCase
{
    /**
     * @dataProvider provideWriters
     * @param ArrayWriterType $writerType
     * @param string $writerClass
     * @return void
     */
    public function test_get_right_writer(ArrayWriterType $writerType, string $writerClass): void
    {
        $sorter = (new ArrayWriterFactory())->getInstance($writerType);
        $this->assertTrue(is_a($sorter, $writerClass));
    }

    public function provideWriters(): \Generator
    {
        yield ArrayWriterType::ToFile->name => [
            ArrayWriterType::ToFile,
            ArrayToFile::class
        ];
        yield ArrayWriterType::ToMYSQL->name => [
            ArrayWriterType::ToMYSQL,
            MysqlWriter::class
        ];
    }
}
