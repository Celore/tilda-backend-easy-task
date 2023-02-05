<?php

declare(strict_types=1);


use Yushenkov\Tilda\Arrays\IntMatrixConsolePrinter;
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

$printer = new IntMatrixConsolePrinter();
$printer->print($matrix);

/**
 * Task 3
 * Есть несколько вариантов как выполнить задачу, зависит от того как работает приложение.
 * Если у нас React-приложение - бэк на ините пришлет значение для телефона и замену будет делать фронт.
 * Если у нас server side rendering и мы не можем править шаблон (заменить DIGITS), то придется буферизировать
 * HTML-шаблон, а затем регуляркой заменять DIGITS на числа в зависимости от определенного по IP города юзера
 */