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
                'message' => 'Seu time não pode ser cadastrado. Entrar em contato com o suporte da Lottoyou.bet'
            ], 422);
        }

        $body = $this->getTeamFromCartola($request->slug);        
        
        if ($body == null) {
            return response()->json([
                'message' => 'Time não encontrado!'
            ], 422);
        } 

        if($user != null) {
            $body->time->email = $user->username;
        }

        if ($body->time->nome_cartola != $request->cartoleiro) {
            return response()->json([
                'message' => 'Nome do cartoleiro inválido para este time!'
            ], 422);
        }

        return response()->json($body, 200);
    }
}
