<?php

require "../vendor/autoload.php";
use aasanchez\Cne;

$elector = new Cne("V", rand(1,100000000));
echo $elector->search()."\n";
