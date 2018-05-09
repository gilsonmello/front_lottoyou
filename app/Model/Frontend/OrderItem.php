<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpert;
use App\Model\Frontend\ScratchCardTheme;
use App\Model\Frontend\Lottery;

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

    public function soccerExpert() {
        return $this->belongsTo(SoccerExpert::class, 'soccer_expert_id');
    }

    public function scratchCard() {
        return $this->belongsTo(ScratchCardTheme::class, 'scratch_card_id');
    }

    public function lottery() {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }
    
}
