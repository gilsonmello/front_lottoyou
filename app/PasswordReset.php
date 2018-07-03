<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PasswordReset extends Model
{
    /**
     * 
     */
    const CREATED_AT = 'created';

    /**
     * 
     */
    const UPDATED_AT = 'modified';

    /**
     * @var bool
     */
    public $timestamps = true;

 	/**
     * 
     * @var array
     */
    public $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * 
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
