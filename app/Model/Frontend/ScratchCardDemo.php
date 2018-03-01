<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScratchCardDemo extends Model
{
	use SoftDeletes;
	
    /**
     * @var bool
     */
    public $timestamps = false;

    protected $appends = [
        
    ];

    /**
     * 
     * @var array
     */
    public $table = 'raspadinha_demonstracoes';

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
