<?php

require "../vendor/autoload.php";
use aasanchez\Cne;

$elector = new Cne("V", "15777118");
echo $elector->search()."\n";
echo $elector->searchPretty()."\n";