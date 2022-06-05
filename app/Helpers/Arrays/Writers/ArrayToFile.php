<?php

namespace App\Helpers\Arrays\Writers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArrayToFile extends Writer implements DownloadInterface
{
    public string $file = "arrays.txt";

    public function write(array $inputArray, array $outputArray, string $sortType): void
    {
        $content = "\nInput array";
        $content .= $this->wrapArray($inputArray);
        $content .= $sortType;
        $content .= $this->wrapArray($outputArray);
        Storage::put($this->file,$content);
    }

    public function download(): StreamedResponse
    {
        return Storage::download($this->file);
    }

    private function wrapArray($array): string
    {
        $content = "";
        foreach ($array as $row) {
            $content .= "\n" . implode(", ", $row);
        }
        return $content . "\n";
    }
}
