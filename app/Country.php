<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
	/**
     * @var bool
     */
    public $timestamps = false;

     /**
     * 
     * @var array
     */
    public $table = 'countries';

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

}
