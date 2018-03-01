<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaspadinhaCapaPremiacao extends Model
{
	use SoftDeletes;
	
	/**
     * @var bool
     */
    public $timestamps = true;

    /**
     * 
     * @var array
     */
    public $table = 'raspadinhas_capa_premiacoes';

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

    /*public function packages(){
        return $this->belongsToMany(\App\Model\Frontend\Package::class, 'categories_has_packages', 'category_id', 'package_id');
    }*/
}
