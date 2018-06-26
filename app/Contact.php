<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     *
     */
    const CREATED_AT = 'created';

    /**
     *
     */
    const UPDATED_AT = 'modified';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     *
     * @var array
     */
    public $table = 'contacts';

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
    public function category()
    {
        return $this->belongsTo(ContactCategory::class, 'category_id');
    }

}
