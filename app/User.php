<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
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

    /**
     * @param $username
     * @return mixed
     */
    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }
}
