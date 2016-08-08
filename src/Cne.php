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
        $this->info = $client->request(
            'GET',
            'http://www.cne.gob.ve/consultamovil',
            [
                'query' => [
                    'tipo' => 'RE',
                    'nacionalidad' => $this->citizenship,
                    'cedula' => $this->dniNumber,
                ],
            ]
        );
        $data = $this->info->getBody();

        return $this->formatter($data);
    }

    private function formatter($data)
    {

        $data = json_decode($data);
        var_dump($data);
        $elector = [];
        $elector["datos-personales"]["cedula"] = $this->clear($data->ci);
        $elector["datos-personales"]["nombre(s)"] = $this->clear($data->nb1." ".$data->nb2);
        $elector["datos-personales"]["apellidos(s)"] = $this->clear($data->ap1." ".$data->ap2);
        $elector["datos-personales"]["nacimiento"] = $this->clear($data->fecha_nacimiento);
        $elector["informacion-electoral"]["centro-de-votacion"]["institucion"] = $this->clear($data->cv);
        $elector["informacion-electoral"]["centro-de-votacion"]["direccion"] = $this->clear($data->dir);
        $elector["informacion-electoral"]["centro-de-votacion"]["parroquia"] = $this->parroquia($this->clear($data->par));
        $elector["informacion-electoral"]["centro-de-votacion"]["municipio"] = $this->municipio($this->clear($data->mcp));
        $elector["informacion-electoral"]["centro-de-votacion"]["estado"] = $this->estado($this->clear($data->stdo));
        $elector["informacion-electoral"]["servicio-electoral"]["estado"] = $this->estado($this->clear($data->servicio));
        $elector["no-definidos"]["st"] = $this->clear($data->st);
        $elector["no-definidos"]["obj"] = $this->clear($data->obj);
        $elector["no-definidos"]["rec"] = $this->clear($data->rec);
        $elector["no-definidos"]["obs"] = $this->clear($data->obs);
        $elector["no-definidos"]["votelec"] = $this->clear($data->votelec);
        $elector["no-definidos"]["mvota"] = $this->clear($data->mvota);
        $elector["no-definidos"]["paglin"] = $this->clear($data->paglin);
        $elector["no-definidos"]["cap_centro"] = $this->clear($data->cap_centro);
        $elector["no-definidos"]["cap_edo"] = $this->clear($data->cap_edo);
        $elector["no-definidos"]["cap_num"] = $this->clear($data->cap_mun);
        $elector["no-definidos"]["cap_par"] = $this->clear($data->cap_par);
        $elector["no-definidos"]["cap_dir"] = $this->clear($data->cap_dir);
        $elector["no-definidos"]["cap_horario"] = $this->clear($data->cap_horario);
        $elector["ultima-actualizacion"] = $this->clear($data->fecha);

        return json_encode($elector);
    }

    private function clear($string)
    {
        $newString = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $newString = strtolower($newString);
        $newString = ucfirst($newString);

        return $newString;
    }

    private function parroquia($parroquia)
    {
        return str_replace("Pq. ", "", $parroquia);
    }

    private function municipio($parroquia)
    {
        return str_replace("Ce. ", "", $parroquia);
    }

    private function estado($parroquia)
    {
        return str_replace("Edo. ", "", $parroquia);
    }
}
