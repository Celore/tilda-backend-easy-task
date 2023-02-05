<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays;

use Yushenkov\Tilda\Arrays\Exceptions\GeneratorRangeException;
use Yushenkov\Tilda\Arrays\Exceptions\MatrixDimensionException;
use Yushenkov\Tilda\Arrays\Exceptions\MatrixWrongDataSetException;
use Yushenkov\Tilda\Arrays\Interfaces\IntGenerator;
use Yushenkov\Tilda\Arrays\Interfaces\Matrix;

class IntMatrixGenerator implements Interfaces\MatrixGenerator
{
    private IntGenerator $intGenerator;

    public function __construct(IntGenerator $intGenerator)
    {
        $this->intGenerator = $intGenerator;
    }

    /**
     * @throws MatrixWrongDataSetException
     * @throws MatrixDimensionException
     * @throws GeneratorRangeException
     */
    public function generate(int $rows, int $columns): Matrix
    {
        $numbers = $this->intGenerator->getNumbers($rows * $columns);
        $dataSet = array_chunk($numbers, $columns);
        $matrix = new IntMatrix($dataSet);

        return $matrix;
    }
}