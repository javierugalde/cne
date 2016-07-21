<?php

require "../vendor/autoload.php";
use aasanchez\Cne;

$elector = new Cne('V','15111444');
print_r($elector->search());