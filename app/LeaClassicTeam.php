<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaClassicTeam extends Model
{
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

    public function leaClassic() 
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function cartoleandoTeam() 
    {
        return $this->belongsTo(CartoleandoTeam::class, 'team_id');
    }
}
