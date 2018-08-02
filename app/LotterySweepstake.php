<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class LotterySweepstake extends Model
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    public $perPage = 15;
    
    //const DELETED_AT = 'deleted_at';

    /**
     * @var bool
     */
    public $timestamps = true;

    /*
        Função comentada para ficar de exemplo de como criar atributo personalizado 
    */
    protected $appends = [
        //'date_and_time'
    ];

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

    public function category() 
    {
    	return $this->belongsTo(Lottery::class, 'lot_categoria_id')
            ->where('active', '=', 1);
    }

    public function creator() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function result() 
    {
    	return $this->hasOne(LotteryResult::class, 'lot_jogo_id');
    }

    public function getDataFimAttribute($date) 
    {
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
