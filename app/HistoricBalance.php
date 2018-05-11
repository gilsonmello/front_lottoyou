<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Balance;
use App\HistoricBalanceSoccer;
use App\HistoricBalanceLottery;
//use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricBalance extends Model
{
    //use SoftDeletes;

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

    public function soccer() 
    {
        return $this->hasOne(HistoricBalanceSoccer::class, 'historic_balance_id');
    }

    public function lottery() 
    {
        return $this->hasOne(HistoricBalanceLottery::class, 'historic_balance_id');
    }

    public function getCreatedAttribute($date) 
    {
        return format($date, 'd/m/Y H:i');
    }
}
