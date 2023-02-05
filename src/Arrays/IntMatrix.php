<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays;

use Yushenkov\Tilda\Arrays\Exceptions\MatrixDimensionException;
use Yushenkov\Tilda\Arrays\Exceptions\MatrixWrongDataSetException;

class IntMatrix implements Interfaces\Matrix
{
    private int $rowsCount;
    private int $columnsCount;
    private array $data;

    /**
     * @throws MatrixWrongDataSetException
     * @throws MatrixDimensionException
     */
    public function __construct(array $data)
    {
        $this->validateData($data);
        $this->rowsCount = $this->rowsCount($data);
        $this->columnsCount = $this->columnsCount($data);
        $this->loadData($data);
    }

    public function getRows(): \Generator
    {
        foreach ($this->data as $row) {

            yield $row;
        }
    }

    public function getColumns(): \Generator
    {
        for ($i = 0; $i < $this->columnsCount; $i++) {
            $column = [];
            foreach ($this->getRows() as $row) {
                $column[] = $row[$i];
            }

            yield $column;
        }
    }

    public function getColumnsCount(): int
    {
        return  $this->columnsCount;
    }

    public function getRowsCount(): int
    {
        return $this->rowsCount;
    }

    /**
     * @throws MatrixDimensionException
     */
    private function rowsCount(array $data): int
    {
        $rowsCount = count($data);
        if ($rowsCount === 0) {
            throw new MatrixDimensionException("Can't create matrix with 0 rows.");
        }

        return $rowsCount;
    }

    /**
     * @throws MatrixDimensionException
     */
    private function columnsCount(array $data): int
    {
        $columnsCounts = array_map(
            function (array $columns) {
                return count($columns);
            },
            $data
        );

        /** @var int $columnsCount */
        $columnsCount = max($columnsCounts);
        if ($columnsCount < 1) {
            throw new MatrixDimensionException("Can't create matrix with no columns.");
        }

        return $columnsCount;
    }

    /**
     * @throws MatrixWrongDataSetException
     */
    private function validateData(array $data): void
    {
        if (!$this->isArrayOfArrays($data)) {
            throw new MatrixWrongDataSetException('Data set is not array of arrays');
        }
    }

    private function isArrayOfArrays(array $data): bool
    {
        $res = is_array($data);
        if ($res) {
            foreach ($data as $v) {
                if (!is_array($v)) {
                    return false;
                }
            }
        }

        return $res;
    }

    /**
     * @param array[] $data
     */
    private function loadData(array $data): void
    {
        foreach ($data as $columns) {
            $this->data[] = $this->prepareColumnValues($columns);
        }
    }

    /**
     * @param array $columns
     * @return array<int, int|null>
     */
    private function prepareColumnValues(array $columns): array
    {
        $columnValues = array_values($columns);
        $this->castColumnValuesToInt($columnValues);
        $this->fillAbsentColumnValues($columnValues);

        return $columnValues;
    }

    private function castColumnValuesToInt(array &$columnValues)
    {
        array_walk($columnValues, function (&$value) {
            $value = (int)$value;
        });
    }

    private function fillAbsentColumnValues(array &$columnValues)
    {
        $absentValuesCount = $this->columnsCount - count($columnValues);
        while ($absentValuesCount--) {
            $columnValues[] = null;
        }
    }
}