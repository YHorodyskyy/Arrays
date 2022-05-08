<?php

namespace App;

class Log
{
    private static string $dir = "logs";
    private static string $file = "arrays.htm";

    public static function write($content): void
    {
        $dir = self::$dir;
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $file = fopen($dir . "/" . self::$file, "a") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }
}