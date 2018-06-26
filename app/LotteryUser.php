<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryUser extends Model
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
    public $table = 'lot_users_jogos';

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

    public function sweepstake() {
    	return $this->belongsTo(LotterySweepstake::class, 'lot_jogo_id');
    }

    public function player() {
    	return $this->belongsTo(User::class, 'jogador_id');
    }

    public function numbers() 
    {
        return $this->hasMany(LotteryUserNumber::class, 'lot_users_jogo_id');
    }

    public function numbersExtras() 
    {
        return $this->hasMany(LotteryUserNumberExtra::class, 'lot_users_jogo_id');
    }

}
