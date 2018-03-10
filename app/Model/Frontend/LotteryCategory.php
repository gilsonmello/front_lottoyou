<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryCategory extends Model
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
    public $table = 'lot_categorias';

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

    public function lotteries() {
    	return $this->hasMany(\App\Model\Frontend\Lottery::class, 'lot_categoria_id');
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
