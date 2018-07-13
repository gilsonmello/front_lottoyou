<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricBalance extends Model
{
    //use SoftDeletes;

    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    //const DELETED_AT = 'deleted_at';

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    public $perPage = 15;
    
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
    public $table = 'historic_balances';

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

    public function balance() 
    {
        return $this->belongsTo(Balance::class, 'balance_id');
    }

    public function soccerExpertBet() 
    {
        return $this->belongsTo(SoccerExpertBet::class, 'soccer_expert_bet_id');
    }

    public function orderItem() 
    {
        return $this->belongsTo(OrderItem::class, 'item_id');
    }

    public function scratchCard() 
    {
        return $this->belongsTo(ScratchCard::class, 'scratch_card_id');
    }

    public function lotteryBet() 
    {
        return $this->belongsTo(LotteryUser::class, 'lottery_bet_id');
    }

    public function devolution() 
    {
        return $this->hasOne(HistoricBalanceDevolution::class, 'historic_balance_id');
    }

    public function pagseguro() 
    {
        return $this->belongsTo(PagseguroOrder::class, 'pagseguro_order_id');
    }

    public function paypal() 
    {
        return $this->belongsTo(PaypalOrder::class, 'paypal_order_id');
    }

    public function agentWithdraw() 
    {
        return $this->belongsTo(AgentWithdraw::class, 'agent_withdraw_id');
    }

    public function paypalWithdraw() 
    {
        return $this->belongsTo(PaypalWithdraw::class, 'paypal_withdraw_id');
    }

    public function balanceInsert() 
    {
        return $this->belongsTo(BalanceInsert::class, 'balance_insert_id');
    }

    public function getCreatedAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
