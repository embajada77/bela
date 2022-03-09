<?php

namespace App;

class TurnoResponsable extends BaseModel
{
    protected $table = 'turnos_responsables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'comision',
		'empleado_id',
		'turno_tratamiento_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    # === FOREING KEYS ============================================================================
    public function turno()
    {
        return $this->belongsTo(Turno::class,'turno_id','id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'empleado_id','id');
    }

    public function turno_tratamiento()
    {
        return $this->belongsTo(TurnoTratamiento::class,'turno_tratamiento_id','id');
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
