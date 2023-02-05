<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays\Interfaces;

interface MatrixPrinter
{

    public function print(Matrix $matrix): void;
}