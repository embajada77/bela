<?php 

namespace App\Traits;

trait TraitCalle {

    use TraitLocalidad;

    public function getLocalidadAttribute()
    {
        return ($this->calle) ? $this->calle->localidad : null;
    }

    public function getLocalidadIdAttribute() 
    {
        return ($this->calle) ? $this->calle->localidad_id : null;
    }

    public function getCalleNombreAttribute()
    {
        return ($this->calle) ? $this->calle->nombre : null;
    }
}