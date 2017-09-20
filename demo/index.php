<?php

require '../vendor/autoload.php';

use aasanchez\Cne;

$cedulas = ['7217609', '24234355', '4308005', '16666860', '5892464', '12160718'];
foreach ($cedulas as $cedula) {
    $elector = new Cne('V', $cedula);
    echo  PHP_EOL.$elector->searchPretty();
}
