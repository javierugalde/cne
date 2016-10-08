<?php

require '../vendor/autoload.php';
use aasanchez\Cne;

$elector = new Cne('V', '15777118');
$elector->search();
header('Content-Type: application/json');
echo $elector->searchPretty();
