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
        $this->app->singleton('App\Contracts\Repositories\UserRepository', 'App\Repositories\UserRepository');
        $this->app->singleton('App\Contracts\Services\UserService', 'App\Services\UserService');
        $this->app->singleton('App\Contracts\Factories\UserFactory', 'App\Factories\UserFactory');
    }
}
