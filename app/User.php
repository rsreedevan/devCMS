<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; 

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

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


    public function settings()
    {
        $this->hasMany('App\UserSetting');
    }

    public function format(){
        $this->created_at = $this->created_at->diffForHumans();
        $this->roles = $this->getRoleNames()->map(function($role){ return trim($role); });
        $this->permissions = $this->getPermissionNames()->map(function($permission){ return trim($permission); });
        return $this;
    }
}
