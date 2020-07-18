<?php

namespace App;

class Telefono extends Contactable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'telefonos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_area',
        'numero',
        'pais_id',
        'tipo_telefono_id'
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
        
        public function tipo_telefono()
        {
            return $this->belongsTo('App\TipoTelefono','tipo_telefono_id','id');
        }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getCodigoPaisAttribute()
        {
        	return ($this->pais) ? $this->pais->tel_prefijo : '';
        }

        public function getPrefijoPaisAttribute()
        {
        	return ($this->pais) ? '+' . $this->codigo_pais : '';
        }

        public function getPrefijoAreaMinAttribute()
        {
        	return ($this->codigo_area != '') ? '(' . $this->codigo_area . ')' : '';
        }

        public function getPrefijoAreaAttribute()
        {
        	return ($this->prefijo_area_min != '') ? '0' . $this->prefijo_area_min : '';
        }

        public function getFullNumberAttribute()
        {
        	return trim($this->prefijo_pais . ' ' . $this->prefijo_area . ' ' . $this->numero);
        }

        public function getMinimalFullNumberAttribute()
        {
        	return trim($this->prefijo_area_min . ' ' . $this->numero);
        }

        public function getContactableNameAttribute()
        {
            return $this->full_number . '[' . $this->tipo_telefono->full_name . ']';
        }

        public function getContactableIconAttribute()
        {
            return $this->tipo_telefono->icono;
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public static function firstOrCreateFromRequest($request)
        {
            $telefono = null;

            $codigo_area        = trim($request['codigo_area']);
            $numero             = trim($request['numero']);
            $pais_id            = trim($request['pais_id']);
            $tipo_telefono_id   = trim($request['tipo_telefono_id']);

            if (($codigo_area != '') && ($numero != '')) {

                $pais = Pais::find($pais_id);
                $tipo_telefono = TipoTelefono::find($tipo_telefono_id);

                $pais_id = (is_null($pais)) ? Pais::ARGENTINA : $pais->id;
                $tipo_telefono_id = (is_null($tipo_telefono)) ? TipoTelefono::CELULAR : $tipo_telefono->id;

                $telefono = Telefono::firstOrCreate([
                    'codigo_area' => $codigo_area,
                    'numero' => $numero,
                    'pais_id' => $pais_id,
                    'tipo_telefono_id' => $tipo_telefono_id
                ]);
            }

            return $telefono;
        }
    # =============================================================================================
}