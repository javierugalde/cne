<?php

namespace CNE;

use GuzzleHttp\Client as Guzzle;

class Cne
{

    function __construct()
    {
    }

    public function search()
    {
        $client = new Guzzle();
        $res = $client->request('GET', 'http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=V&cedula=15777118');
        $body = $res->getBody();
        $data = $this->refactorData(strip_tags($body));

        return json_encode($data);
    }

    private function refactorData($result)
    {
        if (strstr($result, 'DATOS DEL ELECTOR')) {
            $look = array(
                'Cédula:',
                'Nombre:',
                'Estado:',
                'Municipio:',
                'Parroquia:',
                'Centro:',
                'Dirección:',
                'SERVICIO ELECTORAL',
                'Mesa:',
                'Imprimir',
                'Cerrar',
            );
            $info = explode("@", trim(str_replace($look, '@', $result)));
            $name = explode(" ", $info[2]);

            return array(
                "Status" => "OK",
                "CI" => preg_replace('/(\v|\s)+/', ' ', trim($info[1])),
                "Primer Nombre" => preg_replace('/(\v|\s)+/', ' ', trim($name[0])),
                "Segundo Nombre" => preg_replace('/(\v|\s)+/', ' ', trim($name[1])),
                "Primer Apellido" => preg_replace('/(\v|\s)+/', ' ', trim($name[count($name) - 2])),
                "Segundo Apellido" => preg_replace('/(\v|\s)+/', ' ', trim($name[count($name) - 1])),
                "Estado" => preg_replace('/(\v|\s)+/', ' ', trim($info[3])),
                "Municipio" => preg_replace('/(\v|\s)+/', ' ', trim($info[4])),
                "Parroquia" => preg_replace('/(\v|\s)+/', ' ', trim($info[5])),
                "Centro" => preg_replace('/(\v|\s)+/', ' ', trim($info[6])),
                "Servicio" => preg_replace('/(\v|\s)+/', ' ', trim($info[8])),
            );
        } else {
            return array(
                "Status" => "ERR",
                "Description" => "La cédula no es valida, o el elector esta inhabilitado",
            );
        }

    }
}