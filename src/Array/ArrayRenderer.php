<?php

namespace App\Array;

class ArrayRenderer
{
    public static function render($array, $title = ""): void
    {
        $content = "\n\n";
        if (!empty($title)) {
            $content .= "<h2>$title</h2>";
        }
        $content .= "<table style=\"border=1px;\">";
        foreach ($array as $row) {
            $content .= self::wrapRow($row);
        }
        $content .= "</table>";
        $content .= "<style>td { text-align: right}</style>";
        echo $content;
    }

    private static function wrapRow(array $row): string
    {
        $content = "<tr>";
        foreach ($row as $cell) {
            $content .= self::wrapCell($cell);
        }
        $content .= "</tr>";
        return $content;
    }

    private static function wrapCell(int $cell): string
    {
        return "<td>&nbsp;&nbsp;&nbsp;$cell</td>";
    }
}
