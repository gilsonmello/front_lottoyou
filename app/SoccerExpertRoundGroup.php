<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Support\Facades\DB;

/**
 * Class SoccerExpertRoundGroup
 * @package App
 */
class SoccerExpertRoundGroup extends Model
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    //const DELETED_AT = 'deleted_at';
    
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * 
     * @var array
     */
    public $table = 'soc_rodadas_grupos';

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

    /**
     * @var array
     */
    protected $appends = [
        //'count'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round() 
    {
    	return $this->belongsTo(SoccerExpertRound::class, 'soc_rodada_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bets() 
    {
        return $this->hasMany(SoccerExpertBet::class, 'soc_rodada_grupo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() 
    {
        return $this->belongsToMany(User::class, 
            'soc_rodadas_grupos_has_users', 
            'soc_rodadas_grupo_id', 
            'user_id'
        )->withTimestamps();
    }

    /*public function getCountAttribute() {
        return DB::table('soc_rodadas_grupos')
        	->where('soc_rodadas_grupo_id', '=', $this->id)
        	->join(
        		'soc_rodadas_grupos_has_users', 
	        	'soc_rodadas_grupos_has_users.soc_rodadas_grupo_id', 
        		'=',
	        	'soc_rodadas_grupos.id'
        	)
            ->get();            
    }*/
    
}
