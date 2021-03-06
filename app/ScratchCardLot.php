<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ScratchCardLot extends Model
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    //const DELETED_AT = 'deleted_at';

	/**
     * @var bool
     */
    public $timestamps = true;

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
    	return $this->belongsTo(ScratchCardTheme::class, 'temas_raspadinha_id');
    }

    public function scratch_card() {
        return $this->hasMany(ScratchCard::class, 'lote');
    }

    public function getScratchCardWinningAttribute()
    {
        return ScratchCard::selectRaw('count(*) as quantity, premio as jackpot')
            ->where('lote', '=', $this->id)
            ->where('premio', '>', 0)
            ->groupBy(['jackpot'])
            ->orderBy('jackpot', 'DESC')
            ->get();
    }

}
