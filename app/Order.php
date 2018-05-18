<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\OrderItem;

class Order extends Model
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
    public $table = 'orders';

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

    public function purchase()
    {

    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id')
            ->orderBy('created_at', 'DESC');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAtAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
