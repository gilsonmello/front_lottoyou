<?php

namespace App\Traits;
use GuzzleHttp\Client;

/**
 * Trait Cartoleando
 *
 * @package App\Traits
 */
trait LottoyouAdmin
{
    /**
     * Função que faz sorteio da liga mata mata no servidor administrativo
     * 
     * @param null $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function LeaCupsSortearTimes($id = null)
    {
        $client = new Client(['base_uri' => env('APP_CDN') . '/leaCups/sortearTimes/' . $id]);
        $response = $client->request('POST');
        $body = json_decode($response->getBody());
        return $body;
    }
}
