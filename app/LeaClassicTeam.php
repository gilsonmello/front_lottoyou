<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Cartoleando;

class LeaClassicTeam extends Model
{
    use Cartoleando;

    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';
    
    //const DELETED_AT = 'deleted_at';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'p_c' => 'double',
        'p_m' => 'double',
        'p_p' => 'double',
        'p_r' => 'double',
        'p_t' => 'double',
    ];

    /**
     * @var bool
     */
    public $timestamps = true;

    /*
    Função comentada para ficar de exemplo de como criar atributo personalizado
    protected $appends = [
        'scratch_card_winning'
    ];*/

    /**
     * 
     * @var array
     */
    public $table = 'lea_classic_teams';

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
        'cartoleando_team'
    ];

    public function leaClassic() 
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getCartoleandoTeamAttribute($date) 
    {        
        $team = CartoleandoTeam::where('owner_id', '=', $this->owner_id)->get()->first();
        return $this->getTeamFromCartola($team->slug);
    }
}
