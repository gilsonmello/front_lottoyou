<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Cartoleando;

class LeaCupTeam extends Model
{
    use Cartoleando;
    
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';
    
    //const DELETED_AT = 'deleted_at';

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
    public $table = 'lea_cup_teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    protected $appends = [
        'cartoleando_team'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function leaCup() 
    {
        return $this->belongsTo(LeaCup::class, 'lea_cup_id');
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
