<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
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
    public $table = 'leagues';

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

    public function awards() 
    {
        return $this->hasMany(LeagueAward::class, 'league_id');
    }

    /**
     * @param $query
     * @param $string
     * @return mixed
     */
    public function scopeFindBySlug($query, $string) {
        return $query->where('slug', $string)->get()->first();
    }
}
