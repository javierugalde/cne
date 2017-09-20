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
        $this->connect();

        return $this->info->getBody();
    }

    public function searchPretty()
    {
        $this->connect();

        return $this->formatter($this->info->getBody()).PHP_EOL;
    }

    private function connect()
    {
        $client = new Client();
        $this->info = $client->request(
            'GET',
            'http://www.cne.gob.ve/consultamovil',
            [
                'query' => [
                    'tipo'         => 'RE',
                    'nacionalidad' => $this->citizenship,
                    'cedula'       => $this->dniNumber,
                ],
            ]
        );

        return $this->info->getBody();
    }

    private function formatter($data)
    {
        $data = json_decode($data);
        $elector = [];
        $elector['estatus'] = [
            'mensaje'  => ($this->clear($data->st) != '' ? $this->clear($data->st) : 'Esta cedula de identidad se encuentra inscrita en el registro electoral'),
            'objecion' => ($this->clear($data->obj) != '' ? $this->clear($data->obj) : 'Sin Objecion'),
        ];
        $elector['datos-personales'] = [
            'cedula'       => $this->clear($data->ci),
            'nombre(s)'    => $this->clear($data->nb1.' '.$data->nb2),
            'apellidos(s)' => $this->clear($data->ap1.' '.$data->ap2),
            'nacimiento'   => $this->clear($data->fecha_nacimiento),
        ];
        $elector['informacion-electoral'] = [
            'situacion'          => ($this->clear($data->rec) == '' ? 'Ciudadano Registrado en el Registro Electoral' : $this->clear($data->rec)),
            'centro-de-votacion' => [
                'institucion' => $this->clear($data->cv),
                'direccion'   => $this->clear($data->dir),
                'parroquia'   => $this->parroquia($this->clear($data->par)),
                'municipio'   => $this->municipio($this->clear($data->mcp)),
                'estado'      => $this->estado($this->clear($data->stdo)),
                'servicio'    => $this->estado($this->clear($data->servicio)),
            ],
        ];
        $elector['cap'] = [
            'centro'    => $this->clear($data->cap_centro),
            'estado'    => $this->clear($data->cap_edo),
            'municipio' => $this->clear($data->cap_mun),
            'parroquia' => $this->clear($data->cap_par),
            'direccion' => $this->clear($data->cap_dir),
            'horario'   => $this->clear($data->cap_horario),
        ];
        $elector['no-definidos'] = [
            'obs'     => $this->clear($data->obs),
            'votelec' => $this->clear($data->votelec),
            'mvota'   => $this->clear($data->mvota),
            'paglin'  => $this->clear($data->paglin),
        ];
        $elector['ultima-actualizacion'] = $this->clear($data->fecha);

        return json_encode($elector);
    }

    private function clear($string)
    {
        $newString = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $newString = strtolower($newString);
        $newString = ucfirst($newString);
        $newString = $this->puntos($newString);

        return $newString;
    }

    private function parroquia($parroquia)
    {
        return str_replace('Pq. ', '', $parroquia);
    }

    private function municipio($parroquia)
    {
        return str_replace('Ce. ', '', $parroquia);
    }

    private function estado($parroquia)
    {
        return str_replace('Edo. ', '', $parroquia);
    }

    private function puntos($parroquia)
    {
        return str_replace('... ', '', $parroquia);
    }
}
