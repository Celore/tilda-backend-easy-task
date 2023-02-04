<?php

declare(strict_types=1);


use Yushenkov\Tilda\Stairs\StairsPrinter;

require_once 'vendor/autoload.php';

$stairs = new StairsPrinter(100);
$stairs->print();