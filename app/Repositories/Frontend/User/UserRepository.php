<?php

namespace App\Repositories\Frontend\User;

use App\User;
use App\Balance;
use App\Mail\User\CreateEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Traits\PassportToken;

class UserRepository implements UserContract
{
    use PassportToken;
    
	public function __construct() 
	{

	}

    /**
     * @param string $hash
     * @return bool|mixed
     */
	public function activate(string $hash)
    {
        $user = User::where('email_verified', '=', $hash)
            ->where('email_token_expires', '>=', date('Y-m-d H:i:s'))
            /*->where('active', '=', 0)*/
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
        //$user->active = 0;
        $user->nickname = $attributes['nickname'];
        $user->email_verified = str_random(50);
        $date = Carbon::create();
        $user->email_token_expires = $date->addDays(1);
        if($user->save()) {
            $user->nickname2 = $user->name . '_' . $user->id;
            
            Balance::create([
                'owner_id' => $user->id,
                'value' => 0,
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