<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BalanceOrder;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PagseguroOrder extends Model
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
    public $table = 'pagseguro_orders';

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

    public function getStatusAttribute()
    {    
        if($this->attributes['status'] == 1) {
            return 'awaiting payment';
        }   

        if($this->attributes['status'] == 2) {
            return 'in analysis';
        }

        if($this->attributes['status'] == 3) {
            return 'pay';
        }

        if($this->attributes['status'] == 4) {
            return 'available';
        }

        if($this->attributes['status'] == 5) {
            return 'in dispute';
        }

        if($this->attributes['status'] == 6) {
            return 'returned';
        }

        return 'canceled';
    }

    public function balanceOrder() 
    {
        return $this->belongsTo(BalanceOrder::class, 'balance_order_id');
    }

}
