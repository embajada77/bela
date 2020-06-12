<?php

namespace App;

class Genero extends BaseModel
{
    const PERSONERIA_FISICA = 'física';
    const PERSONERIA_JURIDICA = 'jurídica';

    const HOMBRE = 1;
    const MUJER = 2;
    const PERSONA_JURIDICA = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'alias', 
        'descripcion', 
        'personeria', 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getNombreAttribute($attribute) 
        {
            return specialUcwords($attribute);
        }

        public function getAliasAttribute($attribute) 
        {
            return mb_strtoupper($attribute);
        }

        public function getFullNameAttribute() 
        {
            return $this->nombre;
        }

        public function getTipoPersonaNombreAttribute()
        {
            return specialUcwords($this->personeria);
        }

        public function getTipoPersonaFullNameAttribute()
        {
            return 'Persona ' . $this->tipo_persona_nombre;
        }

        public function getTipoPersonaMinimalNameAttribute()
        {
            return $this->iniciales($this->tipo_persona_full_name);
        }

        public function getEsHombreAttribute()
        {
            return ($this->id == Genero::HOMBRE);
        }

        public function getEsMujerAttribute()
        {
            return ($this->id == Genero::MUJER);
        }
    # =============================================================================================

    # === QUERYS ==================================================================================
        public static function listTipoPersonaByFullName($personeria='')
        {
            $items = array(
                Genero::PERSONERIA_FISICA => 'Persona Física',
                Genero::PERSONERIA_JURIDICA => 'Persona Jurídica',
            );

            if ($personeria != '') { 
                if ($personeria == Genero::PERSONERIA_FISICA) { 
                    $items = array(
                        Genero::PERSONERIA_FISICA => 'Persona Física', 
                    );
                }
                if ($personeria == Genero::PERSONERIA_JURIDICA) { 
                    $items = array(
                        Genero::PERSONERIA_JURIDICA => 'Persona Jurídica', 
                    );
                }
            }

            return $items;
        }

        public static function listByFullName($personeria='')
        {
            if ($personeria != '') { 
                $items = Genero::where('personeria',$personeria)->get();
            } else {
                $items = Genero::get();
            }

            $result = $items->mapWithKeys(function ($item, $key) {
                return [$item->id => $item->nombre];
            })->toArray();

            return $result;
        }
    # =============================================================================================
}
