<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
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
    public $table = 'cart_items';

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
    public function cart() 
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
