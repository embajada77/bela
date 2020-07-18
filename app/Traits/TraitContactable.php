<?php 

namespace App\Traits;

use App\Persona;

trait TraitContactable {

    public function contacto()
    {
        return $this->morphOne('App\Contacto', 'contactable');
    }

    public function asociarContacto( Persona $persona, bool $principal, bool $publicidad)
    {
        return $this->contacto()->updateOrCreate(
            ['persona_id' => $persona->id],
            ['principal' => $principal],
            ['publicidad' => $publicidad],
        );
    }
}