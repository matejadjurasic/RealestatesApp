<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        Paginator::useBootstrap();
        /*Illuminate\Support\Facades\Response::macro('prettyJson', function ($data = [], $status = 200, array $headers = [], $options = 0) {
            return Illuminate\Support\Facades\Response::json($data, $status, $headers, JSON_PRETTY_PRINT | $options);
        });*/
    }
}
