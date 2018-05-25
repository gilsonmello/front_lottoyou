<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpert;
use App\Model\Frontend\ScratchCardTheme;
use App\Model\Frontend\Lottery;
use App\Model\Frontend\LotteryUser;
use App\Model\Frontend\ScratchCard;
use App\Model\Frontend\SoccerExpertRound;

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
     Pedido
    */
    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     Categoria do soccer expert do item
    */
    public function soccerExpert() {
        return $this->belongsTo(SoccerExpert::class, 'soccer_expert_id');
    }

    /**
     Tema da raspadinha do item
    */
    public function scratchCard() {
        return $this->belongsTo(ScratchCardTheme::class, 'scratch_card_id');
    }

    /**
     Categoria da loteria do item
    */
    public function lottery() {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }

    /**
     Jogo de Loteria ou seja, as cartelas geradas pelo mesmo item
    */
    public function lotteryGame() {
        return $this->hasMany(LotteryUser::class, 'order_item_id');
    }

    /**
     Jogo de Raspadinha ou seja, a cartela gerada pelo mesmo item
    */
    public function scratchCardGame() {
        return $this->hasMany(ScratchCard::class, 'order_item_id');
    }

    /**
     Jogo de Soccer Expert ou seja, as cartelas geradas pelo mesmo item
    */
    public function soccerExpertGame() {
        return $this->hasMany(SoccerExpertRound::class, 'order_item_id');
    }

    public function getCreatedAtAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
    
}
