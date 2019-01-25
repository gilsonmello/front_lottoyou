<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SoccerExpert
 * @package App
 */
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

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function cycles() 
  {
    return $this->hasMany(SoccerExpertCycle::class, 'soc_categoria_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function rounds() 
  {
    return $this->hasMany(SoccerExpertRound::class, 'soc_categoria_id');
  }

  /**
   * @return string
   */
  public function getImagemCapaAttribute()
  {        
    return env('APP_CDN'). $this->attributes['imagem_capa'];
  }

  /**
   * @param $query
   * @param $string
   * @return mixed
   */
  public function scopeFindBySlug($query, $string) {
    return $query->where('slug', $string)->get()->first();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function orderItems()
  {
    return $this->morphMany(OrderItem::class, 'item');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\MorphOne
   */
  public function orderItem()
  {
    return $this->morphOne(Orderitem::class, 'item');
  }
}
