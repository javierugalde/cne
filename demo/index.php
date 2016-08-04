<?php

require "../vendor/autoload.php";
use aasanchez\Cne;

$citizens = ["V", "E"];
shuffle($citizens);
$dni = rand ( 1, 100000000);
$elector = new Cne($citizens[0], $dni);
echo $elector->search()."\n";

$citizens = ["V", "E"];
shuffle($citizens);
$dni = rand ( 1, 100000000);
$elector = new Cne($citizens[0], $dni);
echo $elector->search()."\n";

$citizens = ["V", "E"];
shuffle($citizens);
$dni = rand ( 1, 100000000);
$elector = new Cne($citizens[0], $dni);
echo $elector->search()."\n";

$citizens = ["V", "E"];
shuffle($citizens);
$dni = rand ( 1, 100000000);
$elector = new Cne($citizens[0], $dni);
echo $elector->search()."\n";

$citizens = ["V", "E"];
shuffle($citizens);
$dni = rand ( 1, 100000000);
$elector = new Cne($citizens[0], $dni);
echo $elector->search()."\n";

