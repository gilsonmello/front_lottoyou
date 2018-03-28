<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Balance;
use App\Country;


class User extends Authenticatable
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';
    
    //const DELETED_AT = 'deleted_at';

    /**
     * @var bool
     */
    public $timestamps = true;

    use HasApiTokens, Notifiable;

    /**
     * 
     * @var array
     */
    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'laravel_password'
    ];

    /**
     * @param $password
     * @return mixed
     */
    public function validateForPassportPasswordGrant($password){
        return Hash::check($password, $this->laravel_password);
    }

    public function balance() {
        return $this->hasOne(Balance::class, 'user_id');
    }

    /**
     * @param $username
     * @return mixed
     */
    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
