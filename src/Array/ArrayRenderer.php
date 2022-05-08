<?php

namespace App\Array;

use App\Log;

class ArrayRenderer
{
    public function render($array, $title = ""): string
    {
        $content = "\n\n";
        if (!empty($title)) {
            $content .= "<h2>$title</h2>";
        }
        $content .= "<table style=\"border=1px;\">";
        foreach ($array as $row) {
            $content .= $this->renderRow($row);
        }
        $content .= "</table>";
        $content .= "<style>td { text-align: right}</style>";
        return $content;
    }

    public function renderAndWriteToFile($array, $title = ""): string
    {
        $content = $this->render($array, $title);
        Log::write($content);
        return $content;
    }

    private function renderCell(int $cell): string
    {
        return "<td>&nbsp;&nbsp;&nbsp;$cell</td>";
    }

    private function renderRow(array $row): string
    {
        $content = "<tr>";
        foreach ($row as $cell) {
            $content .= $this->renderCell($cell);
        }
        $content .= "</tr>";
        return $content;
    }
}
