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
        $user = $request->user();
        $client = new Client(['base_uri' => 'http://api.cartolafc.globo.com/']);
        $response = $client->request('GET', 'time/slug/'.$request->slug,  [
            'headers' => [
                'x-glb-token' => env('X_GLB_TOKEN')
            ]
        ]);
        $body = json_decode($response->getBody());
        if($user != null) {
            $body->time->email = $user->username;
        }
        return response()->json($body, $response->getStatusCode());
    }
}
