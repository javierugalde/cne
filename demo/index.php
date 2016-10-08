<?php

require '../vendor/autoload.php';
use aasanchez\Cne;

$elector = new Cne('V', '15777118');
header('Content-Type: application/json');
//echo $elector->search();
echo $elector->searchPretty();
