<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CartolaController extends Controller
{
    public function findTeamBySlug(Request $request) 
    {
        $client = new Client(['base_uri' => 'http://api.cartolafc.globo.com/']);
        $response = $client->request('GET', 'time/slug/'.$request->slug,  [
            'headers' => [
                'x-glb-token' => env('X_GLB_TOKEN')
            ]
        ]);
        return response()->json(json_decode($response->getBody()), $response->getStatusCode());
    }
}
