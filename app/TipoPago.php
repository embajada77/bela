<?php

namespace App;

class TipoPago extends  BaseModel
{
	const EFECTIVO = 1;
	const CREDITO = 2;
	const DEBITO = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipos_pagos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre', 
        'alias', 
        'descripcion'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
    public function turnos_pagos()
    {
        return $this->hasMany(TurnoPago::class,'tipo_pago_id','id');
    }
    # =============================================================================================

    # === MUTATORS ================================================================================
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getFullNameAttribute()
    {
    	return specialUcwords($this->nombre);
    }
    # =============================================================================================

    # === QUERYS ==================================================================================
    public static function listByFullName()
    {
        $items = static::all();

        return static::getListFields($items,'id','full_name','full_name');
    }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
    public function getCanDropThisAttribute()
    {
        return ($this->telefonos->count() == 0);
    }

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        $resuelto = true;
        
        foreach ($this->telefonos as $telefono) {
            if ( ! $resuelto) { break; }

            $resuelto = $telefono->dropThis($mensaje_error,$force);
        }

        return $resuelto;
    }
    # =============================================================================================
}
