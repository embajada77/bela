<?php 

namespace App;

use DB;

abstract class DivisionGeografica extends BaseModel
{
    # Relación hasMany() 

    abstract public function divisiones_hijas();

    # Nombre de la división política.

    abstract public function getGeoCategoriaAttribute();

    # Indica la cantidad de divisiones hijas que posee.

    public function getDivisionesHijasCantidadAttribute()
    {
        return ($this->divisiones_hijas->count());
    }

    # Indica si es posible borrar el objeto de la base de datos.

    public function getCanDropThisAttribute()
    {
        return ($this->divisiones_hijas->count() == 0);
    }

    # Operación. Borra, elimina de la base de datos todas los elementos "hijos" de este.

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        $resuelto = true;
        
        foreach ($this->divisiones_hijas as $division_geografica) {
            if ( ! $resuelto) { break; }

            $resuelto = $division_geografica->dropThis($mensaje_error,$force);
        }

        return $resuelto;
    }
}
