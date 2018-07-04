<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;

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
            $user = \App\User::where('username', $httpRequest->username)
                ->where('active', '=', 1)
                ->first();

            // Perform your validation here

            if(is_null($user)) {
                return response()->json([
                    'message' => trans('alerts.users.not_active')
                ], 422);
            }

            // If the validation is successfull:
            return $this->issueToken($request);
        }
    }
}
