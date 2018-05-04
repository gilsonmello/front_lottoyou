<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Model\Frontend\LotteryResult;
use App\Model\Frontend\Lottery;

class LotterySweepstake extends Model
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
    public $table = 'lot_jogos';

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

    public function category() {
    	return $this->belongsTo(Lottery::class, 'lot_categoria_id')
            ->where('active', '=', 1);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function results() {
    	return $this->hasMany(LotteryResult::class, 'lot_jogo_id');
    }

    public function getDataFimAttribute($date) {
        return format($date.' '.$this->hora_fim, 'd/m/Y H:i');
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
