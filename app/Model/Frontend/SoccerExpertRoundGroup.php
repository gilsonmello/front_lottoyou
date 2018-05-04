<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpertRound;
use DB;
use App\User;

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

    protected $appends = [
        //'count'
    ];

    public function round() 
    {
    	return $this->belongsTo(SoccerExpertRound::class, 'soc_rodada_id')
            ->where('active', '=', 1);
    }

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
