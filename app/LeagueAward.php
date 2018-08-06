<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueAward extends Model
{
    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'modified_at';
    
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
    public $table = 'league_awards';

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

    public function type() 
    {
        return $this->belongsTo(LeagueAwardType::class, 'type_award_id');
    }
}
