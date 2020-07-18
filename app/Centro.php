<?php

namespace App;

class Centro extends BaseModel
{
    protected $table = 'centros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'alta',
		'baja',
		'habilitado',
		'persona_id',
		'created_by',
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

    public function persona()
    {
        return $this->belongsTo(Persona::class,'persona_id','id');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class,'centro_id','id');
    }

    public function turnos()
    {
        return $this->hasManyThrough(Turno::class,Agenda::class,'centro_id','agenda_id');
    }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getFullNameAttribute()
    {
        return $this->persona ? $this->persona->full_name : '';
    }

    public function getPlusDiarioAttribute()
    {
        return 0;
    }

    public function getComisionDiariaAttribute()
    {
        return 0;
    }

    public function getPlusArmadoAgendaAttribute()
    {
        return 0;
    }

    public function getComisionArmadoAgendaAttribute()
    {
        return 0;
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

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        return DB::transaction( function() use ($mensaje_error,$force) {

            $resuelto = true;
            
            foreach ($this->agendas as $agenda) {
                if ( ! $resuelto) { break; }

                $resuelto = $agenda->dropThis($mensaje_error,$force);
            }

            if ( ! $resuelto) {
                DB::rollback();
            }

            return $resuelto;
        });
    }

    public static function crearAgenda( Carbon $fecha_inicio, Carbon $fecha_fin)
    {
        return DB::transaction( function() use ($paciente,$fecha_inicio,$tratamientos) {

            $agenda = $this->agendas()->create([
                'fecha_inicio'              => $fecha_inicio->format('Y-m-d H:i:s'),
                'fecha_fin'                 => $fecha_fin->format('Y-m-d H:i:s'),
                'estado_id'                 => EstadoAgenda::ACTIVA,
                'created_by'                => optional(auth()->user())->id,

                'plus_diario'               => $this->plus_diario,
                'comision_diaria'           => $this->comision_diaria,
                'plus_armado_agenda'        => $this->plus_armado_agenda,
                'comision_armado_agenda'    => $this->comision_armado_agenda,
            ]);

            return $agenda;
        });
    }
    # =============================================================================================
}
