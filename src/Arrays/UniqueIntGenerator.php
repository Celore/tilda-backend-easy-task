<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays;

use Yushenkov\Tilda\Arrays\Exceptions\GeneratorRangeException;

class UniqueIntGenerator implements Interfaces\IntGenerator
{
    private int $minNumber = PHP_INT_MIN;
    private int $maxNumber = PHP_INT_MAX;
    private array $generatedNumbers = [];
    private int $count;

    /**
     * @inheritDoc
     * @throws GeneratorRangeException
     */
    public function getNumbers(int $count): array
    {
        $this->count = $count;
        $numbers = $this->generateNumbers();
        $this->generatedNumbers = [];

        return $numbers;
    }

    public function setMinNumber(int $num): static
    {
        $this->minNumber = $num;

        return $this;
    }

    public function setMaxNumber(int $num): static
    {
        $this->maxNumber = $num;

        return $this;
    }

    /**
     * @throws GeneratorRangeException
     */
    private function generateNumbers(): array
    {
        $partOfRange = $this->getRange() / $this->count;

        if ($partOfRange < 1) {
            throw new GeneratorRangeException("Range is shorter than count $this->count");
        } elseif ($partOfRange === 1) {
            $numbers = $this->generateWholeRange();
        } elseif ($partOfRange >= 2) {
            $numbers = $this->generateInRange();
        } else {
            $numbers = $this->generate50Range();
        }

        return $numbers;
    }

    private function getRange(): int
    {
        return $this->maxNumber - $this->minNumber + 1;
    }

    private function generateWholeRange(): array
    {
        $numbers = range($this->minNumber, $this->maxNumber);
        shuffle($numbers);

        return $numbers;
    }

    private function generateInRange(): array
    {
        $numbers = [];
        $count = $this->count;
        while ($count--) {
            $numbers[] = $this->getUniqueNumber();
        }

        return $numbers;
    }

    private function getUniqueNumber(): int
    {
        $number = rand($this->minNumber, $this->maxNumber);
        if (!in_array($number, $this->generatedNumbers)) {
            $this->generatedNumbers[] = $number;
            return $number;
        }

        return $this->getUniqueNumber();
    }

    private function generate50Range(): array
    {
        $numbers = range($this->minNumber, $this->maxNumber);
        shuffle($numbers);

        return array_slice($numbers, 0, $this->count);
    }
}