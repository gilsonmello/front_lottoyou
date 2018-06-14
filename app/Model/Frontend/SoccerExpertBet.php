<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpertRound;
use App\Model\Frontend\SoccerExpertRoundGroup;
use App\Model\Frontend\SoccerExpertBetGame;
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
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    public $perPage = 45;

    public function round() {
    	return $this->belongsTo(SoccerExpertRound::class, 'soc_rodada_id');
    }

    public function games() 
    {
        return $this->hasMany(SoccerExpertBetGame::class, 'soc_aposta_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group() {
        return $this->belongsTo(SoccerExpertRoundGroup::class, 'soc_rodada_grupo_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getCreatedAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
