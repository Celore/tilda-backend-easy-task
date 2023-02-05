<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays\Interfaces;

use Yushenkov\Tilda\Arrays\Exceptions\GeneratorRangeException;
use Yushenkov\Tilda\Arrays\Exceptions\MatrixDimensionException;
use Yushenkov\Tilda\Arrays\Exceptions\MatrixWrongDataSetException;

interface MatrixGenerator
{

    /**
     * @throws MatrixWrongDataSetException
     * @throws MatrixDimensionException
     * @throws GeneratorRangeException
     */
    public function generate(int $rows, int $columns): Matrix;
}