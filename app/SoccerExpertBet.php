<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SoccerExpertBet
 * @package App
 */
class SoccerExpertBet extends Model
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
    public $table = 'soc_apostas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    protected $appends = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    public $perPage = 45;

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
    public function games() 
    {
        return $this->hasMany(SoccerExpertBetGame::class, 'soc_aposta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(SoccerExpertRoundGroup::class, 'soc_rodada_grupo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getCreatedAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
