<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\ScratchCardDiscountTable;
use App\Model\Frontend\ScratchCardLot;
use App\Model\Frontend\ScratchCardJackpotTable;
use App\Model\Frontend\ScratchCard;
use DB;

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

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserHasTicket($query, $theme_id, $user_id)
    {
        return ScratchCard::select([
            'temas_raspadinha_id', 
            'owner',
            DB::raw('count(temas_raspadinha_id) as quantity')
        ])
        ->where('owner', '=', $user_id)
        ->where('temas_raspadinha_id', '=', $theme_id)
        ->where('ativo', '=', 0)
        ->groupBy([
            'temas_raspadinha_id', 
            'owner'
        ])
        ->get()
        ->first();
    }

    protected $appends = [
        'total_tickets', 'total_tickets_available'
    ];

    public function scratchCards() {
        return $this->hasMany(ScratchCard::class, 'temas_raspadinha_id');
    }

    public function lot() {
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

    public function getTotalTicketsAvailableAttribute()
    {        
        $total_tickets_available = ScratchCard::select([
            DB::raw('count(temas_raspadinha_id) as total_tickets_available')
        ])
        ->where('ativo', '=', 0)
        ->where('temas_raspadinha_id', '=', $this->id)
        ->groupBy([
            'temas_raspadinha_id', 
        ])
        ->get()
        ->first();
        return $total_tickets_available ? $total_tickets_available->total_tickets_available : null;
    }
}
