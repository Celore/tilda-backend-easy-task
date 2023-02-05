<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays;

use Yushenkov\Tilda\Arrays\Interfaces\Matrix;

class IntMatrixConsolePrinter implements Interfaces\MatrixPrinter
{
    private Matrix $matrix;
    private int $maxDigitCount;
    private string $delimiter = '|';
    private string $rowBreaker = PHP_EOL;

    public function print(Matrix $matrix): void
    {
        $this->matrix = $matrix;
        $columnsSumRow = $this->getColumnsSumRow();
        $this->maxDigitCount = $this->countDigits(max($columnsSumRow));
        $this->printMatrixRows();
        $this->printBottomLine();
        $this->printRow($columnsSumRow, false);
    }

    private function getColumnsSumRow(): array
    {
        $columnsSumRow = [];
        $columns = $this->matrix->getColumns();
        foreach ($columns as $column) {
            $columnsSumRow[] = array_sum($column);
        }

        return $columnsSumRow;
    }

    private function countDigits(int $num): int
    {
        return strlen((string)$num);
    }

    private function printMatrixRows()
    {
        $rows = $this->matrix->getRows();
        foreach ($rows as $row) {
            $this->printRow($row);
        }
    }

    private function printRow(array $row, bool $withSum = true)
    {
        array_walk($row, function (&$num) {
            $delimitersCount = $this->spacesCount($num);
            $num = $num . str_repeat(' ', $delimitersCount);
        });
        echo '[';
        echo implode($this->delimiter, $row);
        echo ']';
        if ($withSum) {
            echo ' = ';
            echo array_sum($row);
        }
        $this->echoBreakRow();
    }

    private function spacesCount(int $num): int
    {
        return $this->maxDigitCount - $this->countDigits($num);
    }

    private function printBottomLine()
    {
        echo str_repeat(
            '=',
            ($this->matrix->getColumnsCount() * $this->maxDigitCount)
            + (($this->matrix->getColumnsCount() - 1) * strlen($this->delimiter))
            + 2
        );
        $this->echoBreakRow();
    }

    private function echoBreakRow(): void
    {
        echo $this->rowBreaker;
    }
}