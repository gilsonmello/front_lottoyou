<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Lottery extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'item');
    }

    public function sweepstakes() 
    {
        return $this->hasMany(LotterySweepstake::class, 'lot_categoria_id');
    }

    public function awards() 
    {
        return $this->hasMany(LotteryAward::class, 'lot_categoria_id');
    }

    public function prices() 
    {
        return $this->hasMany(LotteryPriceQuantity::class, 'lot_categoria_id');
    }

    public function getImgLoteriaAttribute()
    {        
        return env('APP_CDN') . $this->attributes['img_loteria'];
    }

}
