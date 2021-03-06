<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ScratchCard extends Model
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
    public $table = 'raspadinhas';

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
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'item');
    }

    public function theme() {
    	return $this->belongsTo(ScratchCardTheme::class, 'temas_raspadinha_id');
    }

    public function lot() {
        return $this->belongsTo(ScratchCardLot::class, 'lote');
    }

    public function getValor1Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor1'])
            ->get()
            ->first();

        return $number->img;
    }

    public function getValor2Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor2'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor3Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor3'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor4Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor4'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor5Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor5'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor6Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor6'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor7Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor7'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor8Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor8'])
            ->get()
            ->first();
        return $number->img;
    }

    public function getValor9Attribute()
    {
        $number = ScratchCardNumber::where('ras_lote_id', '=', $this->attributes['lote'])
            ->select('id', 'img')
            ->where('number', '=', $this->attributes['valor9'])
            ->get()
            ->first();
        return $number->img;
    }
    
}
