<?php

declare(strict_types=1);

class StairsPrinter
{
    const DELIMITER = ' ';
    const ROW_BREAkER = PHP_EOL;

    private int $stairSize;
    private int $maxDigitCount;
    private string $delimiter;
    private string $rowBreaker;

    public function __construct(
        int    $stairSize,
        string $delimiter = self::DELIMITER,
        string $rowBreaker = self::ROW_BREAkER
    )
    {
        $this->stairSize = $stairSize;
        $this->maxDigitCount = $this->countDigits($stairSize);
        $this->delimiter = $delimiter;
        $this->rowBreaker = $rowBreaker;
    }

    public function print(): void
    {
        $level = 1;
        $num = 0;
        $countOnStep = 0;

        while ($this->stairSize > $num) {
            $num++;
            $countOnStep++;
            $this->echo($num);

            if ($countOnStep === $level) {
                $level++;
                $countOnStep = 0;
                $this->echoBreakRow();
            }
        }
    }

    private function countDigits(int $num): int
    {
        return strlen((string)$num);
    }

    private function echo(int $num): void
    {
        $delimitersCount = $this->delimitersCount($num);
        echo $num . str_repeat($this->delimiter, $delimitersCount);
    }

    private function delimitersCount(int $num): int
    {
        return $this->maxDigitCount - $this->countDigits($num) + 1;
    }

    private function echoBreakRow(): void
    {
        echo $this->rowBreaker;
    }
}