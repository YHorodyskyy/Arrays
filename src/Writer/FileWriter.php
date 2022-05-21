<?php

namespace App\Writer;

class FileWriter extends Writer
{
    private string $dir = "logs";
    private string $file = "arrays.txt";

    public function __construct()
    {
        $this->clear();
    }

    public function write(array $inputArray, array $outputArray, string $sortType): void
    {
        $content = "\nInput array";
        $content .= $this->wrapArray($inputArray);
        $content .= $sortType;
        $content .= $this->wrapArray($outputArray);
        $this->writeString($content);
    }

    public function clear(): void
    {
        $this->checkPath();
        $file = fopen($this->dir . "/" . $this->file, "w") or die("Unable to open file!");
        fclose($file);
    }

    private function writeString($content): void
    {
        $this->checkPath();
        $file = fopen($this->dir . "/" . $this->file, "a") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

    private function wrapArray($array): string
    {
        $content = "";
        foreach ($array as $row) {
            $content .= "\n" . implode(", ", $row);
        }
        return $content . "\n";
    }

    private function checkPath(): void
    {
        if (file_exists($this->dir)) {
            return;
        }
        mkdir($this->dir, 0755, true);
    }
}