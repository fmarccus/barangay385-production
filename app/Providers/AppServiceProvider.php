<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Model::preventLazyLoading(! app()->isProduction());


        // COMMENT WHEN IN DEVELOPMENT SERVER
        // UNCOMMENT BEFORE PUSHING TO PRODUCTION SERVER
        // \URL::forceScheme('https');
    }
}
