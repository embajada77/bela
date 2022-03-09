<?php

namespace App;

class EstadoTurno extends BaseModel
{
    const ACTIVO = 1;
    const FINALIZADO = 2;
    const CANCELADO = 3;
    const SUSPENDIDO = 4;

    protected $table = 'estados_turnos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'alias',
        'descripcion',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
    public function turnos()
    {
        return $this->hasMany(Turno::class,'estado_id','id');
    }
    # =============================================================================================

    # === MUTATORS ================================================================================
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getFullNameAttribute() 
    {
        return ucwords($this->nombre);
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
        return ($this->turnos->count() == 0);
    }
    # =============================================================================================
}
