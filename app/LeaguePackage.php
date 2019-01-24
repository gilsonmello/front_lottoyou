<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LeaguePackage extends Model
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
    public $table = 'lea_packages';

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

    /* public function leagues() 
    {
        return $this->belongsToMany(League::class, 'lea_packages_has_leagues', 'lea_package_id', 'league_id');
    } */

    public function leagues() 
    {
        return $this->hasMany(League::class, 'lea_package_id');
    }

    /**
     * @param $query
     * @param $string
     * @return mixed
     */
    public function scopeFindBySlug($query, $string) {
        return $query->where('slug', $string)
            ->get()
            ->first();
    }    

    /**
     * @param $query
     * @param $string
     * @return mixed
     */
    public function scopeFindBySlugWithLeagues($query, $string) {
        return $query->where('slug', $string)
            ->with(['leagues'])
            ->get()
            ->first();
    }   

    /**
     * @param $query
     * @param $string
     * @return mixed
     */
    public function scopeFindLeaguesBySlug($query, $string) {
        return $query->where('slug', '=', $string)->with([
            'leagues' => function($query) {
                $query->select('*', DB::raw("
                (
                    CASE WHEN leagues.context = 'classic' THEN 'Clássica' 
                    WHEN leagues.context = 'cup' THEN 'Mata Mata'
                    ELSE 'Clássica' 
                    END
                ) AS context
                "));
            },
        ])->get()
        ->first();
    }
}
