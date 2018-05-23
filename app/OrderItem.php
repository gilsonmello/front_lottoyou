<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
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

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    public $perPage = 15;

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function soccerExpert() {
        return $this->belongsTo(SoccerExpert::class, 'soccer_expert_id');
    }

    public function scratchCard() {
        return $this->belongsTo(ScratchCardTheme::class, 'scratch_card_id');
    }

    public function lottery() {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }

    public function getCreatedAtAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
