<?php

namespace CNE;

use GuzzleHttp\Client as Guzzle;
use Symfony\Component\DomCrawler\Crawler as Crawler;

class Cne
{

    function __construct()
    {
    }

    public function search()
    {
        $client = new Guzzle();
        $res = $client->request('GET', 'http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=V&cedula=0001');
        $body = $res->getBody();
        $crawler = new Crawler((string) $body);
        $text = utf8_decode($crawler->text());
        $text = explode("\n", $text);
        $data =  [];
        foreach ($text as $line){
            $line = trim($line);
            if($line != ""){
                array_push($data,$line);
            }
        }
        var_dump($data);

    }
}