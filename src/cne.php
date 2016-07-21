<?php

namespace aasanchez;

use GuzzleHttp\Client;

class Cne
{
    private $citizenship;

    private $dniNumber;

    private $info;

    function __construct($citizenship, $dniNumber)
    {
        $this->citizenship = $citizenship;
        $this->dniNumber = $dniNumber;
    }

    public function search()
    {
        $client = new Client();
        $this->info = $client->request('GET', 'http://www.cne.gob.ve/consultamovil', [
            'query' => [
                'tipo' => 'RE',
                'nacionalidad' => $this->citizenship,
                'cedula' => $this->dniNumber
            ]
        ]);
        return $this->info->getBody();
    }
}
