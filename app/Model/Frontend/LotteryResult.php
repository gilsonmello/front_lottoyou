<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\LotterySweepstake;
use App\Model\Frontend\LotteryNumberExtra;
use App\Model\Frontend\LotteryNumber;
use App\User;

class LotteryResult extends Model
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
    public $table = 'lot_jogos_resultados';

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

    
    public function creator() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function sweepstake() {
        return $this->belongsTo(Sweepstake::class, 'lot_jogo_id');
    }

    public function numbers()
    {
        return $this->hasMany(LotteryNumber::class, 'lot_jogos_resultado_id');
    }

    public function numbersExtras()
    {
        return $this->hasMany(LotteryNumberExtra::class, 'lot_jogos_resultado_id');
    }

    /*
		Função comentada para ficar de exemplo de como criar atributo personalizado
    public function getScratchCardWinningAttribute()
    {
        return ScratchCard::selectRaw('count(*) as quantity, premio as jackpot')
            ->where('lote', '=', $this->id)
            ->where('ativo', '=', 3)
            ->groupBy(['jackpot'])
            ->orderBy('jackpot', 'DESC')
            ->get();
    }*/
}
