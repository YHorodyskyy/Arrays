<?php

namespace App\Http\Controllers;

use App\Helpers\Arrays\ArrayGenerator;
use App\Helpers\Arrays\Sort\ArraySortFactory;
use App\Helpers\Arrays\Sort\ArraySortType;
use App\Helpers\Arrays\Writers\ArrayToFile;
use App\Helpers\Arrays\Writers\ArrayWriterFactory;
use App\Helpers\Arrays\Writers\MysqlWriter;
use App\Models\ArraySort;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArrayController extends Controller
{
    private array $inputArray;
    private array $outputArray;

    public function __construct(
        protected ArraySortFactory $arraySortFactory,
        protected ArrayWriterFactory $arrayWriterFactory,
        protected ArrayToFile $arrayToFile
    )
    {

    }

    public function index(): string
    {
        return view('main');
    }

    public function sortedArray(Request $request): JsonResponse
    {
        $this->prepareArrays($request->array_size, $request->array_sort);

        return response()->json([
            "data" => [
                "inputArray" => $this->inputArray,
                "outputArray" => $this->outputArray,
            ],
            "records" => ArraySort::latest()->get()->toArray()
        ]);
    }

    public function writeToDB(Request $request): JsonResponse
    {
        $this->prepareArrays($request->array_size, $request->array_sort);
        $this->arrayWriterFactory->getInstance(MysqlWriter::class)
            ->write($this->inputArray, $this->outputArray, $request->array_sort);

        return response()->json([
            "data" => [
                "inputArray" => $this->inputArray,
                "outputArray" => $this->outputArray,
            ],
            "records" => ArraySort::latest()->get()->toArray(),
            "message" => "Results written successfully!"
        ]);
    }

    public function downloadArray(Request $request): StreamedResponse
    {
        $this->prepareArrays($request->array_size, $request->array_sort);
        $this->arrayToFile->write($this->inputArray, $this->outputArray, $request->array_sort);
        return $this->arrayToFile->download();
    }

    protected function prepareArrays(int $size, string $sortType): void
    {
        $this->inputArray = (new ArrayGenerator($size))->getArray();
        $sortEngine = $this->arraySortFactory->getInstance(ArraySortType::from($sortType));
        $this->outputArray = $sortEngine->sort($this->inputArray);
    }
}
