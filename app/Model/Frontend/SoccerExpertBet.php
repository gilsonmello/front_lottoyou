<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpertRound;
use App\Model\Frontend\SoccerExpertGame;
use App\User;

class SoccerExpertBet extends Model
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
    public $table = 'soc_apostas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    protected $appends = [
        'house_club', 'out_club'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function round() {
    	return $this->belongsTo(SoccerExpertRound::class, 'soc_rodada_id');
    }

    public function game() {
        return $this->belongsTo(SoccerExpertGame::class, 'soc_jogo_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getHouseClubAttribute()
    {
        return Club::find($this->gel_clube_casa_id);
    }

    public function getOutClubAttribute()
    {
        return Club::find($this->gel_clube_fora_id);
    }
}
