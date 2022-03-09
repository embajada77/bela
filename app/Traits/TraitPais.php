<?php 

namespace App\Traits;

trait TraitPais {

    public function getPaisNombreAttribute()
    {
        return ($this->pais) ? $this->pais->nombre : null;
    }

    public function getPaisAliasAttribute()
    {
        return ($this->pais) ? $this->pais->alias : null;
    }
}