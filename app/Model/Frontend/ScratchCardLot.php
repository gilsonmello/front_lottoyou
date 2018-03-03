<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\ScratchCard;

class ScratchCardLot extends Model
{
	/**
     * @var bool
     */
    public $timestamps = false;

    protected $appends = [
        'scratch_card_winning'
    ];

    /**
     * 
     * @var array
     */
    public $table = 'ras_lotes';

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

    public function scratch_card() {
        return $this->hasMany(ScratchCard::class, 'lote');
    }

    public function getScratchCardWinningAttribute()
    {
        return ScratchCard::selectRaw('count(*) as quantity, premio as jackpot')
            ->where('lote', '=', $this->id)
            ->where('ativo', '=', 3)
            ->groupBy(['jackpot'])
            ->orderBy('jackpot', 'DESC')
            ->get();
    }

}
