<?php

namespace App;

use DB;

class Localidad extends DivisionGeografica
{
    use Traits\TraitDistrito;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'localidades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'categoria',
        'codigo_postal',
        'codigo_area',
        'distrito_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function distrito() 
        {
            return $this->belongsTo('App\Distrito','distrito_id','id');
        }

        public function divisiones_hijas()
        {
            return $this->hasMany('App\Calle','localidad_id','id');
        }

        public function calles()
        {
            return $this->hasMany('App\Calle','localidad_id','id');
        }

        public function domicilios()
        {
            return $this->hasManyThrough('App\Domicilio','App\Calle','localidad_id','calle_id');
        }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getGeoCategoriaAttribute() 
        {
            return ($this->categoria != '') ? $this->categoria : 'Localidad';
        }

        public function getNombreAttribute($attribute)
        {
            return specialUcwords($attribute);
        }

        public function getFullNameAttribute() 
        {
            $full_name = $this->nombre;
            $full_name .= ' - '. $this->distrito_nombre;
            $full_name .= ', '. $this->provincia_nombre;
            $full_name .= '['. $this->pais_nombre .']';
                
            return $full_name;
        }

        public function getMinimalFullNameAttribute() 
        {
            return $this->nombre . ', ' . $this->provincia_nombre;
        }
    # =============================================================================================
    
    # === QUERYS ==================================================================================
        public static function listByFullName($pais_id = 0)
        {
        	if ( isset($pais_id) && ($pais_id > 0) ) {
        	    $items = Localidad::has('distrito.provincia.pais',$pais_id)->get();
        	} else {
        	    $items = Localidad::where('id',92)->get();
        	}
            
    	    $key    = 'id';
    	    $value  = 'full_name';
    	    
    	    return Localidad::getListFields($items,$key,$value);
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public function firstOrCreateCalle($nombre)
        {
            $calle = null;

            $nombre = strtolower(trim($nombre));

            if ($nombre != '') {

                $calle = $this->calles()->updateOrCreate([
                    'nombre' => $nombre,
                ]);
            }

            return $calle;
        }
    # =============================================================================================
}
