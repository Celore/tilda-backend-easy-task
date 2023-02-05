<?php

declare(strict_types=1);


use Yushenkov\Tilda\Arrays\IntMatrixGenerator;
use Yushenkov\Tilda\Arrays\UniqueIntGenerator;
use Yushenkov\Tilda\Stairs\StairsPrinter;

require_once 'vendor/autoload.php';

echo "Task 1" . PHP_EOL;
$stairs = new StairsPrinter(100);
$stairs->print();

echo PHP_EOL . PHP_EOL. "Task 2" . PHP_EOL;

$intGenerator = new UniqueIntGenerator();
$intGenerator->setMinNumber(1)
    ->setMaxNumber(1000);

$matrixGenerator = new IntMatrixGenerator($intGenerator);
$matrix = $matrixGenerator->generate(5, 7);

$printer = new \Yushenkov\Tilda\Arrays\IntMatrixConsolePrinter();
$printer->print($matrix);