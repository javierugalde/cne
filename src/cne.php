<?php

namespace CNE;

use GuzzleHttp\Client as Guzzle;
use Symfony\Component\DomCrawler\Crawler as Crawler;

class Cne
{

    function __construct()
    {
    }

    public function search($citizenship,$dni)
    {

        $dni = $this->cleanDni($dni);
        $dni = $this->completeDni($dni);

        $citizenship=$this->cleanCitizenship($citizenship);
        $query = http_build_query(["nacionalidad" => $citizenship, "cedula" => $dni]);
        $output = [];
        $client = new Guzzle();
        $response = $client->request('GET', 'http://www.cne.gov.ve/web/registro_electoral/ce.php?'.$query);
        if($response->getStatusCode() != 200){
            return ['msg' => 'Error on Server'];
        }
        $body = $response->getBody();
        $crawler = new Crawler((string) $body);
        $text = utf8_decode($crawler->text());
        $text = explode("\n", $text);
        $data =  [];
        foreach ($text as $line){
            $line = trim($line);
            if($line != "" && $line != "Cerrar" && $line != "Imprimir"){
                array_push($data,$line);
            }
        }

        if($data[1] == "ADVERTENCIA"){
            $output = [
                "result" => "Failed",
                "msg" => $data[4]
            ];

        }else{
            $output = $data;
        }


        return $output;

    }

    private function cleanDni($dni){
        return preg_replace('/[^0-9]/', '', $dni);
    }

    private function completeDni($dni){
        return str_pad($dni, 8, "0", STR_PAD_LEFT);
    }

    private function cleanCitizenship($citizenship){

        return preg_replace('/[^VEJ]/', '', substr($citizenship, 0, 1));
    }

}
