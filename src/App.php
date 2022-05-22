<?php

namespace App;

use App\Array\ArrayGenerator;
use App\Array\Sort\ArraySortFactory;
use App\Writer\ArrayWriterFactory;

class App
{
    public function __construct(
        protected ArraySortFactory   $sortFactory = new ArraySortFactory(),
        protected ArrayWriterFactory $writerFactory = new ArrayWriterFactory()
    )
    {
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