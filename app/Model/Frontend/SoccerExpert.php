<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Frontend\SoccerExpertRound;

class SoccerExpert extends Model
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
    public $table = 'soc_categorias';

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

    public function rounds() {
    	return $this->hasMany(SoccerExpertRound::class, 'soc_categoria_id');
    }

    public function getImagemCapaAttribute()
    {        
        return env('APP_CDN'). $this->attributes['imagem_capa'];
    }
}
