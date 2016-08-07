<?php

namespace aasanchez;

use GuzzleHttp\Client;

class Cne
{
    private $citizenship;

    private $dniNumber;

    private $info;

    public function __construct($citizenship, $dniNumber)
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
        return $this->formatter($this->info->getBody());
    }

    private function formatter($data)
    {
        $data = json_decode($data);
        var_dump($data);
        $elector["datos-personales"]["cedula"] = $this->clear($data->ci);
        $elector["datos-personales"]["nombre(s)"] = $this->clear($data->nb1 . " " . $data->nb2);
        $elector["datos-personales"]["apellidos(s)"] = $this->clear($data->ap1 . " " . $data->ap2);
        $elector["datos-personales"]["nacimiento"] = $this->clear($data->fecha_nacimiento);
        $elector["informacion-electoral"]["centro-de-votacion"]["institucion"] = $this->clear($data->cv);
        $elector["informacion-electoral"]["centro-de-votacion"]["direccion"] = $this->clear($data->dir);
        return json_encode($elector);
    }
    private function clear($string){
        $newString = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $newString = strtolower($newString);
        $newString = ucfirst($newString);
        return $newString;
    }

}
