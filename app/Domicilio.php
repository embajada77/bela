<?php

namespace App;

use DB;

class Domicilio extends Contactable
{
    const GON = 17;

    use Traits\TraitCalle;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'domicilios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'altura', 
    	'piso', 
        'extra', 
    	'dpto',
        'calle_id'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function calle() 
        {
            return $this->belongsTo('App\Calle','calle_id','id');
        }

        // public function personas()
        // {
        //     return $this->hasMany('App\Persona','domicilio_id','id');
        // }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getExtraAttribute($attribute)
        {   
            return ucwords($attribute);
        }

        public function getDptoAttribute($attribute)
        {   
            return ucwords($attribute);
        }
    
        public function getFullNameAttribute() 
        {
            $full_name = $this->calle_nombre . ' ' . $this->altura;

            if ($this->complemento != '') {
                $full_name .= ' [' . $this->complemento . ']';
            } 

            return trim($full_name);
        }

        public function getMinimalFullNameAttribute()
        {
            return trim($this->calle_nombre . ' ' . $this->altura);
        }

        public function getComplementoAttribute() 
        {
            $complemento = '';

            if ($this->piso != '') {
                $complemento .= 'Piso '. $this->piso; 
            }

            if ($this->dpto != '') {
                if ($complemento != '') { $complemento .= ' - '; }
                $complemento .= 'Dpto. '. $this->dpto; 
            }

            return $complemento;
        }

        public function getMaximalFullNameAttribute() 
        {
            $maximal_full_name = $this->full_name;

            if ($this->localidad) { 
                $maximal_full_name .= ', ' . $this->localidad_nombre; 
            } 
            
            return $maximal_full_name;
        }

        public function getContactableNameAttribute()
        {
            return $this->full_name;
        }

        public function getContactableIconAttribute()
        {
            return 'glyphicon glyphicon-home';
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public static function firstOrCreateFromRequest($request)
        {
            $domicilio = null;

            $localidad_id   = $request['localidad_id'];
            $calle_nombre   = trim($request['calle_nombre']);
            $altura         = trim($request['altura']);
            $piso           = trim($request['piso']);
            $dpto           = trim($request['dpto']);
            $extra          = trim($request['extra']);

            if (($calle_nombre != '') && ($altura != '')) {

                $localidad = Localidad::find($localidad_id);
                if ($localidad) {

                    $calle = $localidad->firstOrCreateCalle($calle_nombre);
                    if ($calle) {
                        
                        $domicilio = $calle->firstOrCreateDomicilio($altura,$piso,$dpto,$extra);
                    }
                }
            }

            return $domicilio;
        }
    # =============================================================================================
}
