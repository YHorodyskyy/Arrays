<?php

namespace App\Writer;

class PageWriter extends Writer implements OutputInterface
{
    public function write(array $inputArray, array $outputArray, string $sortType): void
    {
        echo $this->prepareToOutput($inputArray, $outputArray, $sortType);
    }

    public function prepareToOutput(array $inputArray, array $outputArray, string $sortType): string
    {
        $content = "\n";
        $content .= "<table><tr><h2>$sortType</h2></tr><tr>";
        $content .= "<td>" . $this->wrapArray($inputArray) . "</td>";
        $content .= "<td><h2>=></h2></td>";
        $content .= "<td>" . $this->wrapArray($outputArray) . "</td>";
        $content .= "</tr></table>";
        $content .= "<style>td { text-align: right}</style>";
        return $content;
    }

    private function wrapArray(array $array): string
    {
        $content = "<table style=\"border=1px;\">";
        foreach ($array as $row) {
            $content .= $this->wrapRow($row);
        }
        $content .= "</table>";
        return $content;
    }

    private function wrapRow(array $row): string
    {
        $content = "<tr>";
        foreach ($row as $cell) {
            $content .= $this->wrapCell($cell);
        }
        $content .= "</tr>";
        return $content;
    }

    private function wrapCell(int $cell): string
    {
        return "<td>&nbsp;&nbsp;&nbsp;$cell</td>";
    }
}
