<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Traits\Cartoleando;

class League extends Model
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
    public function scopeFindBySlug($query, $string) 
    {
        //Pegando a liga
        $league = $query->select([
                '*',
                DB::raw("
                (
                    CASE WHEN {$this->table}.context = 'classic' THEN 'Clássica' 
                    WHEN {$this->table}.context = 'cup' THEN 'Mata Mata'
                    ELSE 'Clássica' 
                    END
                ) AS modality
                ")
            ])
            ->where('slug', $string)
            ->get()
            ->first();
        
        switch ($league->context) {
            case 'classic': {
                $league->classic = $league->classic;
                if ($league->classic->winner_id) {
                    $league->classic->winnerTeam = $this->getTeamFromCartola($league->classic->winner->slug);
                    $league->classic->loserTeam  = $this->getTeamFromCartola($league->classic->loser->slug);
                    $league->classic->thirdTeam  = $this->getTeamFromCartola($league->classic->third->slug);
                    $league->classic->fourthTeam = $this->getTeamFromCartola($league->classic->fourth->slug);
                }
                break;
            }
            case 'cup': {
                $league->cup = $league->cup;
                if ($league->cup->winner_id) {
                    $league->cup->winnerTeam = $this->getTeamFromCartola($league->cup->winner->slug);
                    $league->cup->loserTeam  = $this->getTeamFromCartola($league->cup->loser->slug);
                    $league->cup->thirdTeam  = $this->getTeamFromCartola($league->cup->third->slug);
                    $league->cup->fourthTeam = $this->getTeamFromCartola($league->cup->fourth->slug);
                }
                break;
            }
        }

        return $league;
    }

    public function package() 
    {
        return $this->belongsTo(LeaguePackage::class, 'lea_package_id');
    }

    public function cup() 
    {
        return $this->hasOne(LeaCup::class, 'league_id');
    }

    public function classic() 
    {
        return $this->hasOne(LeaClassic::class, 'league_id');
    }
}
