<?php 

namespace App;

use DB;

abstract class Contactable extends BaseModel
{
    public function contactos()
    {
        return $this->morphMany('App\Contacto', 'contactable');
    }

    abstract public function getContactableNameAttribute();
    abstract public function getContactableIconAttribute();
    abstract public static function firstOrCreateFromRequest($request);

    public static function firstOrCreateContactable( & $mensaje_error, $request, Persona $persona, bool $principal = false, bool $publicidad = false)
    {
        return DB::transaction( function() use ( & $mensaje_error,$request,$persona,$principal,$publicidad) {

            $resuelto = true;

            $contactable = static::firstOrCreateFromRequest($request);

            if ($contactable) {

                $resuelto = $contactable->asociarContacto($persona,$principal,$publicidad);
            }

            if ( ! $resuelto) {
                
                $contactable = null;

                DB::rollback();
            }

            return $contactable;
        });
    }

    public function asociarContacto( Persona $persona, bool $principal, bool $publicidad)
    {
        # Si existe un contacto con la tupla [persona,contactable_type,contactable_id], 
        # actualizo el mismo con los datos [principal,publicidad].
        # Caso contrario, creo el contacto [persona,contactable_type,contactable_id,principal,publicidad].

        return $this->contactos()->updateOrCreate(
            ['persona_id' => $persona->id],
            ['principal' => $principal, 'publicidad' => $publicidad],
        );
    }

    public function getCanDropThisAttribute()
    {
        return ($this->contactos->count() == 0);
    }

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        $resuelto = true;
        
        foreach ($this->contactos as $contacto) {
            if ( ! $resuelto) { break; }

            $resuelto = $contacto->dropThis($mensaje_error,$force);
        }

        return $resuelto;
    }
}
