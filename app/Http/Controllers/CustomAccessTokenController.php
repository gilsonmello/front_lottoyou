<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\User;
use App\UserExclusion;
use Carbon\Carbon;

/**
 * Class CustomAccessTokenController
 * @package App\Http\Controllers
 */
class CustomAccessTokenController extends AccessTokenController
{
    /**
     * Hooks in before the AccessTokenController issues a token
     *
     *
     * @param  ServerRequestInterface $request
     * @return mixed
     */
    public function issueUserToken(ServerRequestInterface $request)
    {
        $httpRequest = request();


        // 1.
        if ($httpRequest->grant_type == 'password') {
            // 2.
            $user = User::where('username', $httpRequest->username)
                ->get()
                ->first();

            if(!is_null($user)) {
                
                //Validando a conta para saber se está desabilitada
                $userExclusion = UserExclusion::where('owner_id', '=', $user->id)
                    ->orderBy('created', 'desc')->get()->first();
                /*$expired = Carbon::parse($userExclusion->expired);
                $now = Carbon::now();*/

                if(!is_null($userExclusion)) {
                    $expired = $userExclusion->expired;
                    $now = date('Y-m-d');

                    if($expired == $now && $userExclusion->forever == 0) {
                        $user->last_login = date('Y-m-d H:i:s');
                        $user->active = 1;
                        $user->ip_address = request()->ip();
                        $user->save();
                        return $this->issueToken($request);
                    } else if($userExclusion->forever == 1) {
                        return response()->json([
                            'message' => trans('alerts.users.account_disable')
                        ], 422);
                    }  else {
                        return response()->json([
                            'message' => trans('alerts.users.account_disable')
                        ], 422);
                    }
                }                
            }            


            //Verificando se o usuário está ativo e não encontra-se deletado
            $user = User::findByUsername($httpRequest->username);
    
            // Perform your validation here
            if(is_null($user)) {
                return response()->json([
                    'message' => trans('alerts.users.not_active')
                ], 422);
            }

            $user->last_login = date('Y-m-d H:i:s');
            $user->ip_address = request()->ip();
            $user->save();

            // If the validation is successfull:
            return $this->issueToken($request);
        }
    }
}
