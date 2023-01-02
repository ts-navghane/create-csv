<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use App\Run;

$shortOptions = "";
$longOptions = ["no_of_rows:"];
$options = getopt($shortOptions, $longOptions);
$noOfRows = $options['no_of_rows'] ?? 5;

$run = new Run((int)$noOfRows);
$run->execute();
