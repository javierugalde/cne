<?php

require "../vendor/autoload.php";
use aasanchez\Cne;

$elector = new Cne('V','15111444');
echo $elector->search()."\n";
