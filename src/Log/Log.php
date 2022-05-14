<?php

namespace App\Log;

class Log
{
    private static string $dir = "logs";
    private static string $file = "log.txt";

    public static function write($content): void
    {
        self::checkPath();
        $file = fopen(self::$dir . "/" . self::$file, "a") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

    public static function clear(): void
    {
        self::checkPath();
        $file = fopen(self::$dir . "/" . self::$file, "w") or die("Unable to open file!");
        fclose($file);
    }

    private static function checkPath(): void
    {
        if (file_exists(self::$dir)) {
            return;
        }
        mkdir(self::$dir, 0755, true);
    }
}