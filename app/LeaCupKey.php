<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaCupKey extends Model
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
    public $table = 'lea_cup_keys';

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

    public function step() 
    {
        return $this->belongsTo(LeaCupStep::class, 'lea_cup_step_id');
    }

    public function homeTeam()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'home_team_id');
    }

    public function outTeam()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'out_team_id');
    }

    public function winner()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'winner_id');
    }

    public function loser()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'loser_id');
    }
}
