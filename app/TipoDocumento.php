<?php

namespace App;

class TipoDocumento extends BaseModel
{
    const PERSONERIA_FISICA = 'física';
    const PERSONERIA_JURIDICA = 'jurídica';

    const DNI = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipos_documentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
    	'alias', 
        'descripcion', 
        'patron', 
        'genero_id', 
        'pais_id' 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function genero() 
        {
            return $this->belongsTo('App\Genero','genero_id','id');
        }

        public function pais() 
        {
            return $this->belongsTo('App\Pais','pais_id','id');
        }

        public function personas()
        {
            return $this->hasMany('App\Persona','tipo_documento_id','id');
        }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getNombreAttribute($value)
        {
            return specialUcwords($value);
        }

        public function getAliasAttribute($value)
        {
            return mb_strtoupper(specialUcwords($value));
        }

        public function getFullNameAttribute()
        {
            return mb_strtoupper($this->alias);
        }

        public function getPersoneriaJuridicaAttribute()
        {
            return ($this->personeria == TipoDocumento::PERSONERIA_JURIDICA);
        }

        public function getPersoneriaFisicaAttribute()
        {
            return ($this->personeria == TipoDocumento::PERSONERIA_FISICA);
        }

        public function getTipoPersonaNombreAttribute()
        {
            $tipo_persona_nombre = 'Persona física y jurídica';
            if ($this->personeria != '') {
                $tipo_persona_nombre = 'Persona ' . mb_strtolower($this->personeria);
            }

            return $tipo_persona_nombre;
        }

        public function getGeneroNombreAttribute()
        {
            $genero_nombre = 'Indistinto';
            if ($this->genero) {
                $genero_nombre = $this->genero->nombre;
            }

            return $genero_nombre;
        }
    # =============================================================================================

    # === QUERYS ==================================================================================
        public function puedoCambiarPersoneria($personeria_id, & $mensaje_error)
        {
            $puedo_cambiar = 1;

            if (($this->personeria_id != $personeria_id) && ( ! is_null($personeria_id))) {

                $tipos_personas_actual = $this->personas->pluck('genero')
                    ->flatten()->pluck('personeria')->unique();
                if ($tipos_personas_actual->count() > 0) {

                    if (($tipos_personas_actual->count() > 1) || ($tipos_personas_actual->first() != $personeria_id)) {

                        $puedo_cambiar = 0;
                        $mensaje_error = 'Existen personas, con este tipo de documento, de un tipo de personeria distinto al que se quiere establecer.';
                    }
                }
            }

            return $puedo_cambiar;
        }

        public function puedoCambiarGenero($genero_id, & $mensaje_error)
        {
            $puedo_cambiar = 1;

            if (($this->genero_id != $genero_id) && ( ! is_null($genero_id))) {

                $generos_actual = $this->personas->pluck('genero_id')->unique();
                if ($generos_actual->count() > 0) {

                    if (($generos_actual->count() > 1) || ($generos_actual->first() != $genero_id)) {

                        $puedo_cambiar = 0;
                        $mensaje_error = 'Existen personas, con este tipo de documento, de un genero distinto al que se quiere establecer.';
                    }
                }
            }

            return $puedo_cambiar;
        }

        public static function listByFullName($pais_id = null, $genero_id = null, $personeria = null)
        {

            $genero = Genero::find($genero_id);
            if ($genero) {
                $personeria = $genero->personeria;
            } else {
                $genero_id = null;
            }

            $items = TipoDocumento::with('genero')
                ->when($pais_id, function ($query) use ($pais_id) {
                    return $query->where(function ($items) use ($pais_id) {
                        $items->whereNull('pais_id')
                            ->orWhere('pais_id',$pais_id); 
                    });
                })
                ->when($genero_id, function ($query) use ($genero_id) {
                    return $query->where(function ($items) use ($genero_id) {
                        $items->whereNull('genero_id')
                            ->orWhere('genero_id',$genero_id); 
                    });
                })
                ->when($personeria, function ($query) use ($personeria) {
                    return $query->where(function ($items) use ($personeria) {
                        $items->where('personeria','')
                            ->orWhere('personeria',$personeria); 
                    });
                })
                ->get();

            $result = $items->mapWithKeys(function ($item, $key) {
                return [$item->id => $item->alias];
            })->toArray();
            
            return $result;
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public function getCanDropThisAttribute()
        {
            return ($this->personas->count() == 0);
        }

        protected function dropRelationships( & $mensaje_error, bool $force = false)
        {
            $resuelto = true;

            foreach ($this->personas as $persona) {
                if ( ! $resuelto) { break; }

                $resuelto = $persona->dropThis($mensaje_error,$force);
            }

            return $resuelto;
        }
    # =============================================================================================
}
