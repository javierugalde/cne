<?php

namespace aasanchez;

use GuzzleHttp\Client;

class Cne
{
    private $citizenship;

    private $dniNumber;

    private $info;

    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct'.$i)) {
            call_user_func_array(array($this, $f), $a);
        }
    }

    function __construct1($a1)
    {

    }

    function __construct2($a1, $a2)
    {
        $this->citizenship = $a1;
        $this->dniNumber = $a2;
    }

    public function search()
    {
        $client = new Client();
        $this->info = json_encode($client->request('GET', 'http://www.cne.gob.ve/consultamovil?tipo=RE&nacionalidad=V&cedula=15777118'));
    }

    public function getBody(){
        return $this->info;
    }
}
