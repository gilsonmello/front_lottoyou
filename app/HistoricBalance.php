<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Balance;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricBalance extends Model
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

    public function balance() {
        return $this->belongsTo(Balance::class, 'balance_id');
    }
}
