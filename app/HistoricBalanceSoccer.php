<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HistoricBalance;

class HistoricBalanceSoccer extends Model
{
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
    public $table = 'historic_balance_soccers';

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

    public function historicBalance() {
        return $this->belongsTo(HistoricBalance::class, 'historic_balance_id');
    }
}
