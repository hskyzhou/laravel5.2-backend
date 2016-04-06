<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('userrepository', function($app){
            return new \App\Repositories\Backend\Userrepository();
        });

        $this->app->bind('rolerepository', function($app){
            return new \App\Repositories\Backend\Rolerepository();
        });

        $this->app->bind('menurepository', function($app){
            return new \App\Repositories\Backend\Menurepository();
        });

        $this->app->bind('permissionrepository', function($app){
            return new \App\Repositories\Backend\Permissionrepository();
        });
    }
}
