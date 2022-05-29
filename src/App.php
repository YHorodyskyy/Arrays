<?php

namespace App;

use App\Array\ArrayGenerator;
use App\Array\Sort\ArraySortFactory;
use App\Http\Controller\IndexController;
use App\Http\Request;
use App\Writer\ArrayWriterFactory;
use JetBrains\PhpStorm\NoReturn;

class App
{
    protected string $homeRoute = "index";

    public function __construct(
        protected ArraySortFactory   $sortFactory = new ArraySortFactory(),
        protected ArrayWriterFactory $writerFactory = new ArrayWriterFactory(),
        protected Request            $request = new Request()
    )
    {
    }

    public function run(): void
    {
        $this->router();
//        $inputArray = (new ArrayGenerator())->getArray();
//        foreach ($this->sortFactory->getAll() as $sortEngine) {
//            $outputArray = $sortEngine->sort($inputArray);
//            foreach ($this->writerFactory->getAll() as $writeEngine) {
//                $writeEngine->write($inputArray, $outputArray, $sortEngine::class);
//            }
//        }
    }

    #[NoReturn] public function router(): void
    {
        $route = $this->homeRoute;
        $action = $this->request->getRawInput("action");
        if ($this->request->getMethod() === "GET") {
            if ($action === "get_html") {
                $route = "getHtml";
            } elseif ($action === "get_file") {
                $route = "getFile";
            } elseif ($action === "write_to_db") {
                $route = "writeToDB";
            };
        }
        $this->runRoute(IndexController::class, $route);
    }

    #[NoReturn] protected function runRoute(string $controller, string $methodName): void
    {
        (new $controller())->$methodName();
    }
}