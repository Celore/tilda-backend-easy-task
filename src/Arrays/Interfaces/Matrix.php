<?php

declare(strict_types=1);

namespace Yushenkov\Tilda\Arrays\Interfaces;

interface Matrix
{

    public function getRows(): \Generator;

    public function getColumns(): \Generator;

    public function getColumnsCount(): int;

    public function getRowsCount(): int;
}