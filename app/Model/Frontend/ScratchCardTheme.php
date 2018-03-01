<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class ScratchCardTheme extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * 
     * @var array
     */
    public $table = 'temas_raspadinhas';

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

    public function lots() {
    	return $this->hasMany(\App\Model\Frontend\ScratchCardLot::class, 'temas_raspadinha_id');
    }
}
