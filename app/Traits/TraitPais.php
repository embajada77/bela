<?php 

namespace App\Traits;

trait TraitPais {

    public function getPaisNombreAttribute()
    {
        return ($this->pais) ? $this->pais->nombre : null;
    }
}