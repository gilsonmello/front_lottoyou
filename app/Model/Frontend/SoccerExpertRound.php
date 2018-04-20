<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpert;
use App\Model\Frontend\SoccerExpertSweepstake;
use App\Model\Frontend\SoccerExpertGame;
use App\Model\Frontend\SoccerExpertRoundGroup;
use App\Model\Frontend\SoccerExpertCycle;
use DB;

class SoccerExpertRound extends Model
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    //const DELETED_AT = 'deleted_at';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * 
     * @var array
     */
    public $table = 'soc_rodadas';

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

    protected $appends = [
        
    ];

    public function bets() 
    {
        return $this->hasMany(SoccerExpertBet::class, 'soc_rodada_id')
            ->where('active', '=', 1);
    }

    public function games() 
    {
        return $this->hasMany(SoccerExpertGame::class, 'soc_rodada_id')
            ->where('active', '=', 1);
    }

    public function category() 
    {
    	return $this->belongsTo(SoccerExpert::class, 'soc_categoria_id')
            ->where('active', '=', 1);
    }

    public function cycle() 
    {
        return $this->belongsTo(SoccerExpertCycle::class, 'soc_ciclo_id')
            ->where('active', '=', 1);
    }

    public function sweepstake() {
    	return $this->belongsTo(SoccerExpertSweepstake::class, 'soc_bolao_id')
            ->where('active', '=', 1);
    }

    public function getImagemCapaAttribute()
    {        
        return env('APP_CDN'). $this->attributes['imagem_capa'];
    }

    public function getDataTerminoAttribute($date) 
    {
        return format($date.' '.$this->hora_termino, 'd/m/Y H:i');
    }

    public function group() 
    {
        return $this->hasOne(SoccerExpertRoundGroup::class, 'soc_rodada_id')
            ->where('active', '=', 1)
            ->where('status', '=', 1);
    }
}