<?php

namespace App;

use DB;

class Calle extends DivisionGeografica
{
    use Traits\TraitLocalidad;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre',
    	'localidad_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function localidad() 
        {
            return $this->belongsTo('App\Localidad','localidad_id','id');
        }

        public function divisiones_hijas()
        {
            return $this->hasMany('App\Domicilio','calle_id','id');
        }

        public function domicilios()
        {
            return $this->hasMany('App\Domicilio','calle_id','id');
        }
    # =============================================================================================
        
    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getGeoCategoriaAttribute() 
        {
            return 'Calle';
        }

        public function getNombreAttribute($attribute)
        {
            return specialUcwords($attribute);
        }

        public function getFullNameAttribute()
        {
            return $this->nombre .', '. $this->localidad->full_name;
        }
    # =============================================================================================

    # === QUERYS ==================================================================================
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public function firstOrCreateDomicilio($altura,$piso,$dpto,$extra)
        {
            $domicilio = null;

            if ($altura != '') {

                $domicilio = $this->domicilios()->updateOrCreate([
                    'altura' => $altura,
                    'piso' => $piso,
                    'dpto' => $dpto,
                    'extra' => $extra,
                ]);
            }

            return $domicilio;
        }
    # =============================================================================================
}
