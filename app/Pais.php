<?php

namespace App;

use DB;

class Pais extends DivisionGeografica
{
    const ARGENTINA = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paises';

    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'nombre_en',
        'iso_alfa2',
        'iso_alfa3',
        'iso_num',
        'categoria',
        'tel_prefijo',
        'lenguaje',
    ];

    /**
     * Black list. The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'nombre_en',
        'iso_alfa2',
        'iso_alfa3',
        'iso_num',
        'tel_prefijo',
        'categoria',
        'lenguaje',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'prefijo_pais'
    ];

    # === FOREING KEYS ============================================================================
        public function divisiones_hijas()
        {
            return $this->hasMany('App\Provincia','pais_id','id');
        }

        public function provincias()
        {
            return $this->hasMany('App\Provincia','pais_id','id');
        }

        public function distritos()
        {
            return $this->hasManyThrough('App\Distrito','App\Provincia','pais_id','provincia_id');
        }

        public function tipos_documentos()
        {
            return $this->hasMany('App\TipoDocumento','pais_id','id');
        }

        public function telefonos()
        {
            return $this->hasMany('App\Telefono','pais_id','id');
        }
    # =============================================================================================
    
    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getGeoCategoriaAttribute() 
        {
            return ($this->categoria != '') ? $this->categoria : 'País';
        }

        public function getProvinciasCantAttribute()
        {
            return $this->provincias->count();
        }

        public function getNombreAttribute($attribute)
        {
            return specialUcwords($attribute);
        }

        public function getFullNameAttribute() 
        {
            return $this->nombre;
        }

        public function getAliasAttribute() 
        {
            return mb_strtoupper($this->iso_alfa3);
        }

        public function getPrefijoPaisAttribute() 
        {
            return '+' . $this->tel_prefijo;
        }
    # =============================================================================================

    # === QUERYS ==================================================================================
        public static function listByFullName($pais_id='')
        {
            if ($pais_id != '') {
                $items = Pais::where('id',$pais_id)->get();
            } else {
                $items = Pais::orderBy('nombre')->get();
            }
                        
            $key = 'id';
            $value = 'full_name';

            return Pais::getListFields($items,$key,$value);
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public function firstOrCreateProvincia($nombre, $alias, $iso, $categoria)
        {
            $provincia = null;

            if ($nombre != '') {

                $nombre     = mb_strtolower(trim($nombre));
                $alias      = mb_strtolower(trim($alias));
                $iso        = mb_strtolower(trim($iso));
                $categoria  = mb_strtolower(trim($categoria));
                
                $provincia = $this->provincias()->updateOrCreate(
                    ['nombre' => $nombre],
                    ['alias' => $alias,'iso' => $iso,'categoria' => $categoria]
                );
            }

            return $provincia;
        }

        public function getCanDropThisAttribute()
        {
            $can_drop_this = true;

            if ($this->divisiones_hijas->count() > 0) { $can_drop_this = false; }
            if ($this->tipos_documentos->count() > 0) { $can_drop_this = false; }
            if ($this->telefonos->count() > 0) { $can_drop_this = false; }

            return $can_drop_this;
        }

        protected function dropRelationships( & $mensaje_error, bool $force = false)
        {
            $resuelto = true;
            
            foreach ($this->divisiones_hijas as $division_geografica) {
                if ( ! $resuelto) { break; }

                $resuelto = $division_geografica->dropThis($mensaje_error,$force);
            }

            # Esta sentencia nos sirve para liberar al objeto de todas sus relaciones,
            # por lo cual ayuda a no alcanzar un limite de memoria 
            # (sobre todo cuando se esta borrando desde una instancia superior).
            $this->refresh();

            foreach ($this->tipos_documentos as $tipo) {
                if ( ! $resuelto) { break; }

                $resuelto = $tipo->dropThis($mensaje_error,$force);
            }

            # Esta sentencia nos sirve para liberar al objeto de todas sus relaciones,
            # por lo cual ayuda a no alcanzar un limite de memoria 
            # (sobre todo cuando se esta borrando desde una instancia superior).
            $this->refresh();

            foreach ($this->telefonos as $telefono) {
                if ( ! $resuelto) { break; }

                $resuelto = $telefono->dropThis($mensaje_error,$force);
            }
                    
            return $resuelto;
        }
    # =============================================================================================
}
