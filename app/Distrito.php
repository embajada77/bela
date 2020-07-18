<?php

namespace App;

use DB;

class Distrito extends DivisionGeografica
{
    use Traits\TraitProvincia;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distritos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'nombre',
        'categoria',
        'provincia_id'
	];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function provincia() 
        {
            return $this->belongsTo('App\Provincia','provincia_id','id');
        }

        public function divisiones_hijas()
        {
            return $this->hasMany('App\Localidad','distrito_id','id');
        }

        public function localidades()
        {
            return $this->hasMany('App\Localidad','distrito_id','id');
        }

        public function calles()
        {
            return $this->hasManyThrough('App\Calle','App\Localidad','distrito_id','localidad_id');
        }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getGeoCategoriaAttribute() 
        {
            return ($this->categoria != '') ? $this->categoria : 'Distrito';
        }

        public function getNombreAttribute($attribute)
        {
            return specialUcwords($attribute);
        }

        /**
         * Define a new attribute for the model, but not for the database.
         */
        public function getFullNameAttribute() 
        {
            return $this->nombre .', '. $this->provincia->full_name;
        }
    # =============================================================================================

    # === QUERYS ==================================================================================
        public static function listByFullName()
        {
            $items = Distrito::all();
            
            $key = 'id';
            $value = 'full_name';

            return Distrito::getListFields($items,$key,$value);
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public function firstOrCreateLocalidad($nombre, $codigo_postal, $codigo_area)
        {
            $localidad = null;

            if ($nombre != '') {

                $nombre = mb_strtolower(trim($nombre));
                
                $localidad = $this->localidades()->updateOrCreate([
                    'nombre' => $nombre,
                    'codigo_postal' => $codigo_postal,
                    'codigo_area' => $codigo_area,
                ]);
            }

            return $localidad;
        }
    # =============================================================================================
}
