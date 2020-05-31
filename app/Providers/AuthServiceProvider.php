<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user.edit', 'App\Policies\UserPolicy@edit');
        
        Gate::define('dashboard.view', function(){
            $user = Auth::user();
            return ($user->hasAnyRole(['admin','super.admin'])) ? Response::allow() : Response::deny('Not Allowed');
        });

        // Master admin role has all permissions 
        Gate::before(function($user, $ability){
            return ($user->hasRole('super.admin'))? true : null;
        });

        //
    }
}
