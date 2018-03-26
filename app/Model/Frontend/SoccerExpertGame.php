<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\Club;
use App\Model\Frontend\SoccerExpertSweepstake;
use App\Model\Frontend\SoccerExpertRound;
use App\User;

class SoccerExpertGame extends Model
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
    public $table = 'soc_jogos';

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
        'house_club', 'out_club'
    ];

    /*public function houseClub() {
        return $this->belongsTo(Club::class, 'gel_clube_casa_id')
            ->where('active', '=', 1);
    }*/

    public function outClub() {
        return $this->belongsTo(Club::class, 'gel_clube_fora_id')
            ->where('active', '=', 1);
    }

    public function round() {
    	return $this->belongsTo(SoccerExpertRound::class, 'soc_rodada_id');
    }

    public function sweepstake() {
        return $this->belongsTo(SoccerExpertSweepstake::class, 'soc_bolao_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getHouseClubAttribute()
    {
        return Club::where('id', '=', $this->gel_clube_casa_id)
            ->with(['shields'])
            ->get()
            ->first();
    }

    public function getOutClubAttribute()
    {
        return Club::where('id', '=', $this->gel_clube_fora_id)
            ->with(['shields'])
            ->get()
            ->first();
    }
}
