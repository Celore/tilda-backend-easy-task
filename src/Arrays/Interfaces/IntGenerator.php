<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays\Interfaces;

use Yushenkov\Tilda\Arrays\Exceptions\GeneratorRangeException;

interface IntGenerator
{

    /**
     * @return int[]
     * @throws GeneratorRangeException
     */
    public function getNumbers(int $count): array;

    public function setMinNumber(int $num): IntGenerator;

    public function setMaxNumber(int $num): IntGenerator;
}