<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Collaborator;
use App\Example;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Binding app  
        $this->app->bind('App\Example', function(){
            $collaborator = new Collaborator();
            $foo = 'dddd';
            return new Example($collaborator, $foo); 
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
