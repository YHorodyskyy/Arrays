<?php

namespace App\Helpers\Arrays\Writers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArrayToFile extends Writer implements DownloadInterface
{
    private string $file;
    private string $disk;

    public function __construct(string $file = "", $disk = "")
    {
        $this->file = $file ? $file : "arrays.txt";
        $this->disk = $disk ? $disk : config("filesystems.default");
    }

    public function write(array $inputArray, array $outputArray, string $sortType): void
    {
        $content = "\nInput array";
        $content .= $this->wrapArray($inputArray);
        $content .= $sortType;
        $content .= $this->wrapArray($outputArray);
        Storage::disk($this->disk)->put($this->file,$content);
    }

    public function download(): StreamedResponse
    {
        return Storage::disk($this->disk)->download($this->file);
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
