<?php

namespace App\Traits;

use GuzzleHttp\Client;

/**
 * Trait Cartoleando
 *
 * @package App\Traits
 */
trait Cartoleando
{
    public function getTeamFromCartola($slug, $round = null)
    {
        try {
            $client = new Client(['base_uri' => 'http://api.cartolafc.globo.com/']);
            $url = $round != null ? 'time/slug/'.$slug.'/'.$round : 'time/slug/'.$slug;
            $response = $client->request('GET', $url,  [
                'headers' => [
                    'x-glb-token' => env('X_GLB_TOKEN')
                ]
            ]);
            $body = json_decode($response->getBody());
            return $body;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getRodada()
    {
        $client = new Client(['base_uri' => 'https://api.cartolafc.globo.com/']);
        $response = $client->request('GET', 'mercado/status/',  [
            'headers' => [
                'x-glb-token' => env('X_GLB_TOKEN')
            ]
        ]);
        return json_decode($response->getBody());
    }
}
