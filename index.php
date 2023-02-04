<?php

declare(strict_types=1);

require_once 'src/StairsPrinter.php';

$stairs = new StairsPrinter(100);
$stairs->print();