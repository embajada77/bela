<?php 

namespace App\Traits;

trait TraitDistrito {

    use TraitProvincia;

    public function getProvinciaAttribute()
    {
        return ($this->distrito) ? $this->distrito->provincia : null;
    }

    public function getProvinciaIdAttribute() 
    {
        return ($this->distrito) ? $this->distrito->provincia_id : null;
    }

    public function getDistritoNombreAttribute()
    {
        return ($this->distrito) ? $this->distrito->nombre : null;
    }
}