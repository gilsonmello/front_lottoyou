<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\CartItem;
use App\Model\Frontend\Lottery;
use App\Model\Frontend\ScratchCardTheme;

class Cart extends Model
{
    use SoftDeletes;
    
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
    public $table = 'carts';

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

    public function items() {
        return $this->hasMany(CartItem::class, 'cart_id')
            ->orderBy('created_at', 'DESC');
    }

}
