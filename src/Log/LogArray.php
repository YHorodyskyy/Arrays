<?php

namespace App\Log;

class LogArray extends Log
{
    public static function write2DArray(array $array, $prefix = "", $postfix = ""): void
    {
        $content = $prefix;
        foreach ($array as $row){
            $content .= "\n".implode(", ", $row);
        }
        self::write($content.$postfix."\n");
    }
}