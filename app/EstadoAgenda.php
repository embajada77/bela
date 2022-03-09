<?php

namespace App;

class EstadoAgenda extends BaseModel
{
    const ACTIVA = 1;
    const FINALIZADA = 2;
    const CANCELADA = 3;
    const SUSPENDIDA = 4;

    protected $table = 'estados_agendas';

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
    public function agendas()
    {
        return $this->hasMany(Agenda::class,'estado_id','id');
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
        return ($this->agendas->count() == 0);
    }
    # =============================================================================================
}
