<?php

namespace App;

use DB;

class Provincia extends DivisionGeografica
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'provincias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'alias',
        'iso',
        'categoria',
        'pais_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function pais() 
        {
            return $this->belongsTo('App\Pais','pais_id','id');
        }

        public function divisiones_hijas()
        {
            return $this->hasMany('App\Distrito','provincia_id','id');
        }

        public function distritos()
        {
            return $this->hasMany('App\Distrito','provincia_id','id');
        }

        public function localidades()
        {
            return $this->hasManyThrough('App\Localidad','App\Distrito','provincia_id','distrito_id');
        }
    # =============================================================================================
        
    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getGeoCategoriaAttribute() 
        {
            return ($this->categoria != '') ? $this->categoria : 'Provincia';
        }

        public function getNombreAttribute($attribute)
        {
            return specialUcwords($attribute);
        }

        public function getFullNameAttribute() 
        {
			return $this->nombre . ' [' . mb_strtoupper($this->pais->alias) . ']';
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public function firstOrCreateDistrito($nombre)
        {
            $distrito = null;

            if ($nombre != '') {

                $nombre = mb_strtolower(trim($nombre));
                
                $distrito = $this->distritos()->updateOrCreate([
                    'nombre' => $nombre,
                ]);
            }

            return $distrito;
        }
    # =============================================================================================
}
