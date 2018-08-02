<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SoccerExpertGame
 * @package App
 */
class SoccerExpertGame extends Model
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
    public $table = 'soc_jogos';

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
        //'house_club', 
        //'out_club', 
        'result_house_club', 'result_out_club', 'day'
    ];

    /*public function houseClub() {
        return $this->belongsTo(Club::class, 'gel_clube_casa_id')
            ->where('active', '=', 1);
    }*/

    public function outClub() 
    {
        return $this->belongsTo(Club::class, 'gel_clube_fora_id')
            ->where('active', '=', 1);
    }

    public function round() 
    {
    	return $this->belongsTo(SoccerExpertRound::class, 'soc_rodada_id')
            ->where('active', '=', 1);
    }

    public function sweepstake() 
    {
        return $this->belongsTo(SoccerExpertSweepstake::class, 'soc_bolao_id')
            ->where('active', '=', 1);
    }

    public function creator() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function houseClub() 
    {
        return $this->belongsTo(Club::class, 'gel_clube_casa_id');
    }


    public function getHouseClubAttribute()
    {
        return Club::where('id', '=', $this->gel_clube_casa_id)
            ->select('id', 'nome', 'escudo', 'abreviacao', 'created', 'modified')
            ->where('active', '=', 1)
            ->get()
            ->first();
    }

    public function getOutClubAttribute()
    {
        return Club::where('id', '=', $this->gel_clube_fora_id)
            ->select('id', 'nome', 'escudo', 'abreviacao', 'created', 'modified')
            ->where('active', '=', 1)
            ->get()
            ->first();
    }

    public function getResultHouseClubAttribute()
    {   
        return '';
    }

    public function getResultOutClubAttribute()
    {   
        return '';
    }

    public function getDataAttribute()
    {   
        return format($this->attributes['data'] . ' '. $this->attributes['hora'], 'd/m/Y H:i');
    }

    public function getDayAttribute() 
    {
        // Array com os dias da semana
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

        // Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
        $diasemana_numero = date('w', strtotime($this->attributes['data']));

        // Exibe o dia da semana com o Array
        return $diasemana[$diasemana_numero];
    }
}
