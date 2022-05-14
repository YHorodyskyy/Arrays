<?php

namespace App;

use App\Array\ArrayGenerator;
use App\Array\ArrayRenderer;
use App\Log\LogArray;

class BaseController
{
    public function run(): void
    {
        LogArray::clear();
        $generator = new ArrayGenerator();
        $array = $generator->getArray();
        ArrayRenderer::render($array, "Input Array");
        LogArray::write2DArray($array);

        $sortClasses = [
            "\App\Array\Sort\Horizontal",
            "\App\Array\Sort\Vertical",
            "\App\Array\Sort\Snake",
            "\App\Array\Sort\Diagonal",
            "\App\Array\Sort\Snail",
        ];
        foreach ($sortClasses as $class) {
            $this->renderAndLogArray($class, $array);
        }
    }

    private function renderAndLogArray($className, $array): void
    {
        $engine = new $className();
        $engine->sort($array);
        ArrayRenderer::render($array, $className);
        LogArray::write2DArray($array, $className);
    }
}