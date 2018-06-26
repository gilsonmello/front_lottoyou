<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
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
    public $table = 'contact_categories';

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
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'category_id');
    }
}
