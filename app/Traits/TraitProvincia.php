<?php 

namespace App\Traits;

trait TraitProvincia {

    use TraitPais;

    public function getPaisAttribute()
    {
        return ($this->provincia) ? $this->provincia->pais : null;
    }

    public function getPaisIdAttribute() 
    {
        return ($this->provincia) ? $this->provincia->pais_id : null;
    }

    public function getProvinciaNombreAttribute()
    {
        return ($this->provincia) ? $this->provincia->nombre : null;
    }
}