<?php

namespace App\Repositories\API\User;

use App\PasswordReset;
use App\User;
use App\Balance;
use App\Mail\User\CreateEmail;
use App\Mail\User\ForgotPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Traits\PassportToken;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\SoccerExpertBet;
use App\ScratchCard;
use App\LotteryUser;
use App\UserExclusion;

class UserRepository implements UserContract
{
    use PassportToken;

	public function __construct() 
	{

    }

    public function exists($request) 
    {
        $user = User::where('username', '=', $request->email)->get()->first();

        if($user != null) {
            return User::where('username', '=', $request->email)
                ->with('country', 'balance')
                ->get()
                ->first();
        }        
        
        return false;
    }

    /**
     * @return mixed
     */
    public function disable($request) {
        $user = User::find($request->owner_id);

        /*$soccerExpertBet = SoccerExpertBet::where('owner_id', '=', $user->id)->get()->isEmpty();
        $scratchCard = ScratchCard::where('owner', '=', $user->id)->get()->isEmpty();
        $lotteryUser = LotteryUser::where('jogador_id', '=', $user->id)->get()->isEmpty();*/

        $userExclusion = new UserExclusion;
        $userExclusion->owner_id = $user->id;
        $userExclusion->forever = 0;
        $userExclusion->type_exclusion = $request->type_exclusion;
        $carbon = new Carbon();
        if($request->type_exclusion == 4) {
            $userExclusion->forever = 1;
        } else if($request->type_exclusion == 0) {
            $userExclusion->expired = $carbon->addMonths(1);
        } else if($request->type_exclusion == 1) {
            $userExclusion->expired = $carbon->addMonths(3);
        } else if($request->type_exclusion == 2) {            
            $userExclusion->expired = $carbon->addMonths(6);
        } else if($request->type_exclusion == 3) {
            $userExclusion->expired = $carbon->addYears(1);
        }
        

        if($userExclusion->save()) {
            $user->active = 0;

            /*if($soccerExpertBet && $scratchCard && $lotteryUser) {
                $user->deleted = Carbon::now();
            }*/
            
            if($user->save()) {
                return true;
            }
        }

        return false;
    }
    
    /**
     * 
     */
    public function forgotPassword(array $attributes) 
    {
        $locale = Cookie::get('locale');
        $birth_date = format($attributes['birth_date'], 'd-m-Y', $locale);        
        
        $user = User::where('username', '=', $attributes['email'])
            ->where(DB::raw("concat(birth_year, '-', birth_month, '-', birth_day)"), '=', $birth_date)
            ->get()
            ->first();

        if(!is_null($user)) {
            $passwordReset = new PasswordReset;
            $passwordReset->user_id = $user->id;
            $passwordReset->token = str_random(191);
            $passwordReset->save();
            Mail::to($user->username)
                ->send(new ForgotPasswordEmail($user, $passwordReset));
            return true;
        }
        return false;
    }

    /**
     * 
     */
    public function checkTokenActivation($token) 
    {
        return false;
    }

    /**
     * 
     */
    public function checkTokenForgotPassword($token) 
    {
        $passwordReset = PasswordReset::where('token', '=', $token)
            ->where('active', '=', 1)
            ->get()
            ->first();

        if(!is_null($passwordReset)) {
            $passwordReset->active = 0;
            if($passwordReset->save()) {
                return true;
            }
            return false;
        }

        return false;
    }

    /**
     * 
     */
    public function checkTokenPasswordRecovery($token) 
    {
        $passwordReset = PasswordReset::where('token', '=', $token)
            ->where('active', '=', 1)
            ->get()
            ->first();

        if(!is_null($passwordReset)) {
            $passwordReset->active = 0;
            if($passwordReset->save()) {
                return true;
            }
            return false;
        }

        return false;
    }

    /**
     * 
     */
    public function passwordRecovery($token, array $attributes) 
    {
        $passwordReset = PasswordReset::where('token', '=', $token)
            ->get()
            ->first();

        $user = User::find($passwordReset->user_id);

        if(!is_null($passwordReset)) {
            $user->laravel_password = bcrypt($attributes['password']);
            if($user->save()) {
                return true;
            } else {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * @param string $hash
     * @return bool|mixed
     */
	public function activate(string $hash)
    {
        $user = User::where('email_verified', '=', $hash)
            /* ->where('email_token_expires', '>=', date('Y-m-d H:i:s')) */
            ->where('active', '=', 0)
            ->get()
            ->first();
        if($user) {
            $user->active = 1;
            if($user->save()) {
                return $this->getBearerTokenByUser($user, 1, false);
            }
        }
        return false;
    }

    /**
     * @param array $attributes
     * @return bool|mixed
     */
	public function createFromFacebook(array $attributes) 
	{
        $user = User::where('username', '=', $attributes['email'])->get()->first();
        if(!is_null($user)) {
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            return $user;
        } 

		$user = new User;
        $user->name = $attributes['name'];
        $user->last_name = $attributes['last_name'];
        $user->username = $attributes['email'];
        $user->nickname = $attributes['short_name'];
        $user->group_id = 3;
        $user->gel_empresa_id = 8;
        $user->active = 1;
        $user->provider = 'facebook';
        $user->last_login = date('Y-m-d H:i:s');
        $user->gender = isset($attributes['gender']) ? $attributes['gender'] : null;
        if(isset($attributes['birth_day'])) {
            $user->birth_day = (int) $attributes['birth_day'] < 10 ? '0'.$attributes['birth_day'] : $attributes['birth_day'];
        } else {
            $user->birth_day = null;
        }
        $user->birth_month = isset($attributes['birth_month']) ? $attributes['birth_month'] : null;
        $user->birth_year = isset($attributes['birth_year']) ? $attributes['birth_year'] : null;
        $user->country_id = isset($attributes['country']) ? $attributes['country'] : 231;
        if($user->save()) {
            $user->nickname2 = $user->name . '_' . $user->id;
            $user->save();
            Balance::create([
                'owner_id' => $user->id,
                'value' => 0,
            ]);
            /*$user->save();
            Mail::to($user->username)
                ->send(new CreateEmail($user));*/
            return $user;
        }

        return false;
	}

    /**
     * @param array $attributes
     * @return bool|mixed
     */
	public function create(array $attributes) 
	{
		$user = new User;
        $user->name = $attributes['name'];
        $user->last_name = $attributes['last_name'];
        $user->username = $attributes['email'];
        $user->laravel_password = bcrypt($attributes['password']);
        $user->password = '';
        $user->group_id = 3;
        $user->gel_empresa_id = 8;
        $user->birth_day = (int) $attributes['birth_day'] < 10 ? '0'.$attributes['birth_day'] : $attributes['birth_day'];
        $user->birth_month = $attributes['birth_month'];
        $user->birth_year = $attributes['birth_year'];
        $user->country_id = $attributes['country'];
        $user->gender = $attributes['gender'];
        $user->active = 0;
        $user->nickname = $attributes['nickname'];
        $user->email_verified = str_random(50);
        $date = Carbon::create();
        //$user->email_token_expires = $date->addDays(1);
        if($user->save()) {
            $user->nickname2 = $user->name . '_' . $user->id;           

            $balance = 0.05;

            /* $quantity_users = User::where('active', '=', 1)
                ->where('group_id', '=', 3)
                ->where('gel_empresa_id', '=', 8)
                ->get();

            if($quantity_user->count() >= 2000) {
                $balance = 0.05;
            } */

            Balance::create([
                'owner_id' => $user->id,
                'value' => $balance,
            ]);

            $user->save();
            Mail::to($user->username)
                ->send(new CreateEmail($user));
            return true;
        }

        return false;
	}

    /**
     * @param $id
     * @param array $attributes
     */
	public function update($id, array $attributes)
	{

	}

    /**
     * @param $id
     */
	public function delete($id)
	{

	}
}