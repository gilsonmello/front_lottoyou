<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class League extends Model
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
        return $query
            ->select([
                '*',
                DB::raw("
                (
                    CASE WHEN leagues.context = 'classic' THEN 'Clássica' 
                    WHEN leagues.context = 'cup' THEN 'Mata Mata'
                    ELSE 'Clássica' 
                    END
                ) AS modality
                ")
            ])
            ->with([
                'cup',
                'classic'
            ])
            ->where('slug', $string)
            ->get()
            ->first();
    }

    public function packages() 
    {
        return $this->belongsToMany(LeaguePackage::class, 'lea_packages_has_leagues', 'league_id', 'lea_package_id');
    }

    public function cup() 
    {
        return $this->hasOne(LeaCup::class, 'league_id');
    }

    public function classic() 
    {
        return $this->hasOne(LeaClassic::class, 'league_id');
    }

    public function classicTeams()
    {
        return $this->hasMany(LeaClassicTeam::class, 'league_id');
    }

    public function cupTeams()
    {
        return $this->hasMany(LeaCupTeam::class, 'league_id');
    }
}
