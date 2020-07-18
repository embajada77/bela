<?php

namespace App\Traits;

trait TraitLocalidad {

    use TraitDistrito;

    public function getDistritoAttribute()
    {
        return ($this->localidad) ? $this->localidad->distrito : null;
    }

    public function getDistritoIdAttribute() 
    {
        return ($this->localidad) ? $this->localidad->distrito_id : null;
    }

    public function getLocalidadNombreAttribute()
    {
        return ($this->localidad) ? $this->localidad->nombre : null;
    }
}