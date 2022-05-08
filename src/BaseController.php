<?php

namespace App;

use App\Array\ArrayGenerator;
use App\Array\ArrayRenderer;
use App\Array\Sort\Diagonal;
use App\Array\Sort\Horizontal;
use App\Array\Sort\Snail;
use App\Array\Sort\Snake;
use App\Array\Sort\Vertical;

class BaseController
{

    public function run(): void
    {
        $this->index();
    }

    public function index(): void
    {
        $generator = new ArrayGenerator();
        $startArray = $generator->newArray();
        $renderer = new ArrayRenderer();

        echo $renderer->renderAndWriteToFile($startArray, "Input Array");

        $engine = new Horizontal();
        echo $renderer->renderAndWriteToFile($engine->sort($startArray), "Horizontal sort");

        $engine = new Vertical();
        echo $renderer->renderAndWriteToFile($engine->sort($startArray), "Vertical sort");

        $engine = new Snake();
        echo $renderer->renderAndWriteToFile($engine->sort($startArray), "Snake sort");

        $engine = new Diagonal();
        echo $renderer->renderAndWriteToFile($engine->sort($startArray), "Diagonal sort");

        $engine = new Snail();
        echo $renderer->renderAndWriteToFile($engine->sort($startArray), "Snail sort");
    }
}