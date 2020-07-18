<?php

namespace App\Providers;

use App\{User,Agenda};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\AgendaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Agenda' => 'App\Policies\AgendaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::before(function( User $user) {
            // return $user->is_owner;

            if ( ! $user->habilitado) {
                # le niego cualquier permiso, independientemente de las demas reglas.
                return false;
            }

            if ($user->isAn('owner')) {
                # le otorgo todos los permisos, independientemente de las demas reglas.
                return true;
            }

            # No defino nada, se define a partir de las demas reglas.
            return null;
        });

        // -------------------------------------------- todas son equivalentes
        # Paso 1:
        // Gate::define('view-agenda',function( User $user, Agenda $agenda) {
        //     return ($user->centro) ? ($user->centro->id == $agenda->centro->id) : false;
        // });

        # Paso 2:
        // Gate::define('view-agenda','App\Policies\AgendaPolicy@view');
        // Gate::define('create-agenda','App\Policies\AgendaPolicy@create');
        // Gate::define('update-agenda','App\Policies\AgendaPolicy@update');
        // Gate::define('delete-agenda','App\Policies\AgendaPolicy@delete');
        
        # Paso 3:
        // Gate::resource('agenda',AgendaPolicy::class);
        # Esto cambia el nombre de las reglas a x ej. 'agenda.view'

        # Paso 4:
        # Si queremos definir mas reglas que las que vienen por defecto
        // Gate::resource('agenda',AgendaPolicy::class,[
        //     'nombre_regla' => 'nombre_metodo'
        //     // 'update' => 'update'
        // ]);
        // --------------------------------------------
    }
}
