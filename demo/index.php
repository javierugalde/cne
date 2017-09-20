<?php

require '../vendor/autoload.php';
use aasanchez\Cne;

$elector = new Cne('V', '7217609');
header('Content-Type: application/json');
echo $elector->searchPretty();
echo PHP_EOL;
$elector = new Cne('V', '24234355');
echo $elector->searchPretty();
echo PHP_EOL;
$elector = new Cne('V', '4308005');
echo $elector->searchPretty();
echo PHP_EOL;
$elector = new Cne('V', '16666860');
echo $elector->searchPretty();
echo PHP_EOL;
$elector = new Cne('V', '5892464');
echo $elector->searchPretty();
echo PHP_EOL;
$elector = new Cne('V', '12160718');
echo $elector->searchPretty();