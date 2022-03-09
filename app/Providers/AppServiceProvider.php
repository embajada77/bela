<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Bouncer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Bouncer::tables([
            'abilities' => 'bouncer_abilities',
            'permissions' => 'bouncer_permissions',
            'roles' => 'bouncer_roles',
            'assigned_roles' => 'bouncer_assigned_roles',
        ]);
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
