<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpertRound;
use App\Model\Frontend\SoccerExpertGame;
use App\Model\Frontend\SoccerExpertRoundGroup;
use App\Model\Frontend\SoccerExpertBet;
use App\User;

class SoccerExpertBetGame extends Model
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
    public $table = 'soc_apostas_jogos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    protected $appends = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function game() {
        return $this->belongsTo(SoccerExpertGame::class, 'soc_jogo_id');
    }

    public function bet() 
    {
        return $this->belongsTo(SoccerExpertBet::class, 'soc_aposta_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
