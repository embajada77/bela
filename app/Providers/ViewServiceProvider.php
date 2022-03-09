<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('owner', function () {
            return optional(auth()->user())->isAn('owner');
        });

        Blade::if('admin', function () {
            return optional(auth()->user())->isAn('admin');
        });
    }
}
