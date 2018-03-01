<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class ScratchCard extends Model
{
 	/**
     * 
     * @var array
     */
    public $table = 'raspadinhas';

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

    public function theme() {
    	return $this->belongsTo(\App\Model\Frontend\ScratchCardTheme::class, 'temas_raspadinha_id');
    }

    public function lot() {
        return $this->belongsTo(\App\Model\Frontend\ScratchCardLot::class, 'lote');
    }
    
}
