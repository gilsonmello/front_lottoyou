<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Traits\Cartoleando;

class CartolaController extends Controller
{
    use Cartoleando;

    /**
     * 
     */
    public function __construct() 
    {
        if(isset(request()->header()['authorization'])) {
            $this->middleware('auth:api');
        }
    }

    /**
     * 
     */
    public function findTeamBySlug(Request $request) 
    {
        $user = $request->user();
        $team = null;

        $userHasTeam = false;
        
        if($user != null) {
            $team = \App\CartoleandoTeam::where('slug', '=', $request->slug)
                ->where('owner_id', '=', $user->id)
                ->get()
                ->first();
            if($team) {
                $userHasTeam = true;
            }
        }

        if($user == null) {
            $team = \App\CartoleandoTeam::where('slug', '=', $request->slug)
                ->get()
                ->first();
        }
       
        //Se o time já existe e não encontrei o usuário
        if(!is_null($team) && $userHasTeam == false) {
            return response()->json([
                'message' => 'O time informado já encontra-se cadastrado no sistema.'
            ], 422);
        }

        $body = $this->getTeamFromCartola($request->slug);
        if($user != null) {
            $body->time->email = $user->username;
        }
        return response()->json($body, $response->getStatusCode());
    }
}
