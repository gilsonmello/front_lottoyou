<?php namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Balance;
use App\Country;
use App\PasswordReset;
use App\Traits\Cartoleando;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    /**
     *
     */
    use HasApiTokens, Notifiable, Cartoleando;

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
    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'laravel_password'
    ];

    protected $appends = [
        'cartoleando_team'
    ];

    /**
     * @param $password
     * @return mixed
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->laravel_password);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance() 
    {
        return $this->hasOne(Balance::class, 'owner_id');
    }

    /**
     * @param $username
     * @return mixed
     */
    public function findForPassport($username) 
    {
        return $this->where('username', $username)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country() 
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team() 
    {
        return $this->hasOne(CartoleandoTeam::class, 'owner_id');
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getCartoleandoTeamAttribute($date) 
    {        
        $team = CartoleandoTeam::where('owner_id', '=', $this->id)->get()->first();
        return $team != null ? $this->getTeamFromCartola($team->slug) : null;
    }

    /**
     * 
     */
    public function passwordResets() 
    {
        return $this->hasMany(PasswordReset::class, 'user_id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByUsername($query, $username)
    {
        return $query->where('username', $username)
                ->where('active', '=', 1)
                ->whereNull('deleted')
                ->get()
                ->first();
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByName($query, $name)
    {
        return $query->where('name', $name)
                ->where('active', '=', 1)
                ->whereNull('deleted')
                ->get()
                ->first();
    }
}
