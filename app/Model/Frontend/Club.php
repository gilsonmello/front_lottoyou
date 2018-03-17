<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
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
    public $table = 'gel_clubes';

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

    public function house() {
        return $this->hasMany(SoccerExpertGame::class, 'gel_clube_casa_id');
    }

    public function out() {
        return $this->hasMany(SoccerExpertGame::class, 'gel_clube_fora_id');
    }
}
