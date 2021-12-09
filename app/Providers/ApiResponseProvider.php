<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ApiResponseHandler;

class ApiResponseProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('api.response', function ($app) {
            return new ApiResponseHandler;
        });
    }
}
