<?php

namespace App\Http\Controller;

use App\Array\ArrayGenerator;
use App\Array\Sort\ArraySortFactory;
use App\Http\Request;
use App\Render\Blade;
use App\Render\RenderInterface;
use App\Writer\ArrayWriterFactory;
use App\Writer\FileWriter;
use App\Writer\MysqlWriter;
use JetBrains\PhpStorm\NoReturn;

class IndexController extends BaseController
{
    private string $sortersNameSpace = "\App\Array\Sort\\";
    private int $arraySize;
    private string $sortType;

    public function __construct(
        protected ArraySortFactory   $sortFactory = new ArraySortFactory(),
        protected ArrayWriterFactory $writerFactory = new ArrayWriterFactory(),
        protected RenderInterface    $render = new Blade(),
        protected Request            $request = new Request()
    )
    {
        $this->arraySize = $this->request->getRawInput("array_size") >= 2 && $this->request->getRawInput("array_size") <= 10
            ? $this->request->getRawInput("array_size")
            : 3;
        $this->sortType = $this->sortersNameSpace . $this->request->getRawInput("array_sort");
    }

    public function index(): void
    {
        $this->render->render("index");
    }

    public function getHtml(): void
    {
        $inputArray = (new ArrayGenerator($this->arraySize))->getArray();
        $sortEngine = $this->sortFactory->getInstance($this->sortType);
        $outputArray = $sortEngine->sort($inputArray);

        $response["data"]["inputArray"] = $inputArray;
        $response["data"]["outputArray"] = $outputArray;
        $this->returnJSON($response);
    }

    #[NoReturn] public function getFile(): void
    {
        $inputArray = (new ArrayGenerator($this->arraySize))->getArray();
        $sortEngine = $this->sortFactory->getInstance($this->sortType);
        $outputArray = $sortEngine->sort($inputArray);
        $this->writerFactory->getInstance(FileWriter::class)->write($inputArray, $outputArray, $sortEngine::class);

        $attachment_location = "logs/arrays.txt";
        $this->returnFile($attachment_location, "array.txt");
    }

    public function writeToDB(): void
    {
        $inputArray = (new ArrayGenerator($this->arraySize))->getArray();
        $sortEngine = $this->sortFactory->getInstance($this->sortType);
        $outputArray = $sortEngine->sort($inputArray);
        $this->writerFactory->getInstance(MysqlWriter::class)->write($inputArray, $outputArray, $sortEngine::class);

        $response["data"]["inputArray"] = $inputArray;
        $response["data"]["outputArray"] = $outputArray;
        $response["message"] = "Results written successfully!";
        $this->returnJSON($response);
    }

    #[NoReturn] protected function returnFile(string $file, string $asFileName): void
    {
        if (file_exists($file)) {
            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:" . filesize($file));
            header("Content-Disposition: attachment; filename=$asFileName");
            readfile($file);
            die();
        } else {
            die("Error: File not found.");
        }
    }

    protected function returnJSON($data): void
    {
        header('Content-type: application/json');
        echo json_encode($data);
    }
}