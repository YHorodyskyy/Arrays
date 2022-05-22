<?php

namespace App;

use App\Array\ArrayGenerator;
use App\Array\Sort\ArraySortFactory;
use App\Writer\ArrayWriterFactory;

class App
{
    private ArraySortFactory $sortFactory;
    private ArrayWriterFactory $writerFactory;

    public function __construct()
    {
        $this->sortFactory = new ArraySortFactory();
        $this->writerFactory = new ArrayWriterFactory();
    }

    public function run(): void
    {
        $inputArray = (new ArrayGenerator())->getArray();
        foreach ($this->sortFactory->getAll() as $sortEngine) {
            $outputArray = $sortEngine->sort($inputArray);
            foreach ($this->writerFactory->getAll() as $writeEngine) {
                $writeEngine->write($inputArray, $outputArray, $sortEngine::class);
            }
        }
    }
}