<?php

namespace App;

class TurnoPago extends BaseModel
{
    protected $table = 'turnos_pagos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'importe',
		'aumento',
		'descuento',
		'tipo_pago_id',
		'turno_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    # === FOREING KEYS ============================================================================
    public function usuario()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function metodo_pago()
    {
        return $this->belongsTo(TipoPago::class,'tipo_pago_id','id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class,'turno_id','id');
    }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    # =============================================================================================

    # === REPOSITORIO =============================================================================
    public function getCanDropThisAttribute()
    {
        return true;
    }
    # =============================================================================================
}
