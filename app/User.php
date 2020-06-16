<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles; 

class User extends Authenticatable
{
    use Billable;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set Default Value to an attribute
     * 
     * @var array
     */
    protected $attributes = [
        'password' => 'password'
    ];


    public function settings()
    {
        $this->hasMany('App\UserSetting');
    }

    public function setPasswordAttribute($value = 'password')
    {
        return Hash::make($value);
    }

    public function format()
    {
        $this->created_at = $this->created_at->diffForHumans();
        $this->roles = $this->getRoleNames()->map(function($role){ return trim($role); });
        $this->permissions = $this->getPermissionNames()->map(function($permission){ return trim($permission); });
        return $this;
    }
}
