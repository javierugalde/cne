<?php

namespace CNE;

use Goutte\Client;

class Cne
{
    private $citizenship;

    private $dniNumber;

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

        $crawler = $client->request('GET', 'http://www.cne.gob.ve/consultamovil?tipo=RE&nacionalidad=&cedula=15777118');

        return $crawler;
    }


    private function cleanDni($dni)
    {
        return preg_replace('/[^0-9]/', '', $dni);
    }

    private function completeDni($dni)
    {
        return str_pad($dni, 8, "0", STR_PAD_LEFT);
    }

    private function cleanCitizenship($citizenship)
    {
        return preg_replace('/[^VEJ]/', '', substr($citizenship, 0, 1));
    }

}
