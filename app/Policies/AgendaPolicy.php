<?php

namespace App\Policies;

use App\Agenda;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AgendaPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return Response::allow();
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $user->isAn('organizer');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Agenda  $agenda
     * @return mixed
     */
    public function view(User $user, Agenda $agenda)
    {
        // return ($user->centro) ? ($user->centro->id == $agenda->centro->id) : false;

        if (($user->centro) && ($user->centro->id == $agenda->centro->id)) {
            return Response::allow('',200);
        } else {
            return Response::deny('No tienes el permiso para ver esta agenda.',401);
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAn('organizer')) {
            return Response::allow('',200);
        } else {
            return Response::deny('No tienes el permiso para crear una nueva agenda.',401);
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Agenda  $agenda
     * @return mixed
     */
    public function update(User $user, Agenda $agenda)
    {
        if ($user->centro->id == $agenda->centro->id) {
            return Response::allow('',200);
        } else {
            return Response::deny('No tienes el permiso para editar esta agenda.',401);
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Agenda  $agenda
     * @return mixed
     */
    public function delete(User $user, Agenda $agenda)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Agenda  $agenda
     * @return mixed
     */
    public function restore(User $user, Agenda $agenda)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Agenda  $agenda
     * @return mixed
     */
    public function forceDelete(User $user, Agenda $agenda)
    {
        //
    }
}
