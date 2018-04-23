<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\Order;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    
    /**
     * @var bool
     */
    public $timestamps = true;

    protected $appends = [
        
    ];

    /**
     * 
     * @var array
     */
    public $table = 'order_items';

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

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
}
