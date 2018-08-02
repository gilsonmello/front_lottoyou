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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function balance() 
    {
        return $this->belongsTo(Balance::class, 'balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function soccerExpertBet() 
    {
        return $this->hasOne(SoccerExpertBet::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderItem() 
    {
        return $this->hasOne(OrderItem::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function scratchCard() 
    {
        return $this->hasOne(ScratchCard::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lotteryBet() 
    {
        return $this->hasOne(LotteryUser::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function devolution() 
    {
        return $this->hasOne(HistoricBalanceDevolution::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pagseguro() 
    {
        return $this->hasOne(PagseguroOrder::class, 'historic_balance_id');
    }

    public function paypal() 
    {
        return $this->hasOne(PaypalOrder::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agentWithdraw() 
    {
        return $this->hasOne(AgentWithdraw::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paypalWithdraw() 
    {
        return $this->hasOne(PaypalWithdraw::class, 'historic_balance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balanceInsert() 
    {
        return $this->hasOne(BalanceInsert::class, 'historic_balance_id');
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getCreatedAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
