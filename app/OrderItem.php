<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    
    /**
     * @var bool
     */
    public $timestamps = true;

    protected $appends = [
        'lottery',
        'scratch_card',
        'soccer_expert',
        'league'
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
     * Categoria da loteria do item
     */
    public function historicBalance() 
    {
        return $this->belongsTo(HistoricBalance::class, 'historic_balance_id');
    }

    /**
     * Pedido
     */
    public function order() 
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Categoria do soccer expert do item
     */
    public function getSoccerExpertAttribute() 
    {
        if ($this->type == 'soccer_expert') {
            return SoccerExpert::where('id', '=', $this->context_id)->get()->first();
        }
        return null;
    }

    /**
     * Tema da raspadinha do item
     */
    public function getScratchCardAttribute() 
    {
        if ($this->type == 'scratch_card') {
            return ScratchCardTheme::where('id', '=', $this->context_id)->get()->first();
        }
        return null;
    }

    /**
     * Categoria da loteria do item
     */
    public function getLotteryAttribute() 
    {
        if ($this->type == 'lottery') {
            return Lottery::where('id', '=', $this->context_id)->get()->first();    
        }
        return null;
    }

    /**
     * Categoria da loteria do item
     */
    public function leaPackage() 
    {
        return $this->belongsTo(LeaguePackage::class, 'lea_package_id');
    }

     /**
     * Categoria da loteria do item
     */
    public function getLeagueAttribute() 
    {
        if($this->type == 'cartoleando') {
            return League::where('id', '=', $this->context_id)->get()->first();    
        }
        return null;
    }

    /**
     * Jogo de Loteria ou seja, as cartelas geradas pelo mesmo item
     */
    public function lotteryGames() 
    {
        return $this->hasMany(LotteryUser::class, 'order_item_id');
    }

    /**
     * Jogo de Raspadinha ou seja, gerada pelo mesmo item
     */
    public function scratchCardGame() 
    {
        return $this->hasMany(ScratchCard::class, 'order_item_id');
    }

    /**
     * Jogo de Soccer Expert ou seja, as cartelas geradas pelo mesmo item
     */
    public function soccerExpertGames() 
    {
        return $this->hasMany(SoccerExpertBet::class, 'order_item_id');
    }

    public function getCreatedAtAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
    
}
