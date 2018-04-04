<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\ScratchCardDiscountTable;
use App\Model\Frontend\ScratchCardLot;
use App\Model\Frontend\ScratchCardJackpotTable;

class ScratchCardTheme extends Model
{
    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    //const DELETED_AT = 'deleted_at';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * 
     * @var array
     */
    public $table = 'temas_raspadinhas';

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

    protected $appends = [
        'total_tickets'
    ];

    public function lots() {
    	return $this->hasOne(ScratchCardLot::class, 'temas_raspadinha_id')
            ->where('active', '=', 1);
    }

    public function discountTables() {
        return $this->hasMany(ScratchCardDiscountTable::class, 'tema_id')
            ->where('active', '=', 1);
    }

    public function jackpotTables() {
        return $this->hasMany(ScratchCardJackpotTable::class, 'tema_raspadinha_id')
            ->where('active', '=', 1);
    }

    public function getTotalTicketsAttribute()
    {
        return ScratchCardLot::selectRaw('qtd_raspadinhas')
            ->where('temas_raspadinha_id', '=', $this->id)
            ->get()
            ->first();
    }

    public function getImgBackgroundUrlAttribute()
    {        
        return env('APP_CDN'). $this->attributes['img_background_url'];
    }

    public function getImgCapaUrlAttribute()
    {        
        return env('APP_CDN'). $this->attributes['img_capa_url'];
    }

    public function getImgCardUrlAttribute()
    {        
        return env('APP_CDN'). $this->attributes['img_card_url'];
    }
}
