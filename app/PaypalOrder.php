<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BalanceOrder;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PaypalOrder extends Model
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
    public $table = 'paypal_orders';

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

    public function getPaymentStatusAttribute()
    {    
        return strtolower($this->attributes['payment_status']);
    }

    public function balanceOrder() 
    {
        return $this->belongsTo(BalanceOrder::class, 'balance_order_id');
    }
}
