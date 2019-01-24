<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaClassic extends Model
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
    public $table = 'lea_classics';

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

    public function league() 
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function teams()
    {
        return $this->hasMany(LeaClassicTeam::class, 'lea_classic_id');
    }

    public function winner()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'winner_id');
    }

    public function loser()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'loser_id');
    }

    public function third()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'third_id');
    }

    public function fourth()
    {
        return $this->belongsTo(CartoleandoTeam::class, 'fourth_id');
    }
}
