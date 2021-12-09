<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Repositories\UserRepository', 'App\Repositories\UserRepository');
        $this->app->bind('App\Contracts\Services\UserService', 'App\Services\UserService');
    }
}
