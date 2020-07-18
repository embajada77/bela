<?php

namespace App;

use Carbon\Carbon;
use DB;

class Turno extends BaseModel
{
    protected $table = 'turnos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'fecha_inicio',
		'fecha_fin',
		'observaciones',
		'estado_id',
		'paciente_id',
		'agenda_id',
		'created_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [
    	'fecha_inicio',
    	'fecha_fin'
    ];
    
    # === FOREING KEYS ============================================================================
    public function usuario()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoTurno::class,'estado_id','id');
    }
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'paciente_id','id');
    }
    
    public function agenda()
    {
        return $this->belongsTo(Agenda::class,'agenda_id','id');
    }

    public function pagos()
    {
        return $this->hasMany(TurnoPago::class,'turno_id','id');
    }

    public function tratamientos()
    {
        return $this->hasMany(TurnoTratamiento::class,'turno_id','id');
    }

    public function responsables()
    {
        return $this->hasManyThrough(TurnoResponsable::class,TurnoTratamiento::class,'turno_id','turno_tratamiento_id');
    }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getFullNameAttribute()
    {
    	$full_name = $this->fecha_inicio->format('Y-m-d H:i');
		$full_name .= ' ' . $this->paciente->full_name;
		$full_name .= ' (' . $this->centro->full_name . ')';

		return $full_name;
    }

    public function getMaximalNameAttribute()
    {
    	$maximal_name = $this->full_name;
		$maximal_name .= ' [' . $this->tratamientos->implode('full_name',', ') . ']';

		return $maximal_name;
    }

    public function getCentroAttribute()
    {
    	return $this->agenda ? $this->agenda->centro : null;
    }

    public function getTurnosSolapadosAttribute()
    {
        $turnos_solapados = $this->agenda->turnos->filter(function($item) {
            
            $solapado = false; 

            if ($item->id != $this->id) {
                if ( ! ($item->fecha_inicio->gt($this->fecha_fin) || $item->fecha_fin->lt($this->fecha_inicio))) {
                    $solapado = true;
                }
            }

            return $solapado;
        });

        return $turnos_solapados;
    }

    public function getFechaFinSegunTratamientosAttribute()
    {
        $fecha_fin = $this->fecha_inicio;

        foreach ($this->tratamientos as $tratamiento) {

            $fecha_fin->addHours($tratamiento->duracion->format('H'));
            $fecha_fin->addMinutes($tratamiento->duracion->format('i'));
            $fecha_fin->addSeconds($tratamiento->duracion->format('s'));
        }

        return $fecha_fin;
    }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
    public function getCanDropThisAttribute()
    {
        $can_i = true;

        if ($this->tratamientos->count() > 0) { $can_i = false; }
        if ($this->pagos->count() > 0) { $can_i = false; }

        return $can_i;
    }

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        return DB::transaction( function() use ($mensaje_error,$force) {

            $resuelto = true;
            
            foreach ($this->pagos as $pago) {
                if ( ! $resuelto) { break; }

                $resuelto = $pago->dropThis($mensaje_error,$force);
            }
            
            foreach ($this->tratamientos as $tratamiento) {
                if ( ! $resuelto) { break; }

                $resuelto = $tratamiento->dropThis($mensaje_error,$force);
            }

            if ( ! $resuelto) {
                DB::rollback();
            }

            return $resuelto;
        });
    }

    public function actualizarTurno( Carbon $fecha_inicio, Collection $tratamientos, & $mensaje_error)
    {
        # code...
    }

    public function setFechaFin( Carbon $fecha_fin = null, & $mensaje_error)
    {
        $resuelto = true;

        $fecha_fin_segun_tratamientos = $this->fecha_fin_segun_tratamientos;

        if ($fecha_fin) {
            if ($fecha_fin->gt($this->fecha_inicio)) {
                if ($fecha_fin->ge($fecha_fin_segun_tratamientos)) {

                    $resuelto = false;
                    $mensaje_error = 'El turno debería durar al menos hasta ' . $fecha_fin_segun_tratamientos->format('d-m-Y H:i:s') . '.';
                }
            } else {
                $resuelto = false;
                $mensaje_error = 'El horario de finalización debe ser posterior al de inicialización.';
            }
        } else {
            $fecha_fin = $fecha_fin_segun_tratamientos;
        }

        if ($resuelto) {
            $this->fecha_fin = $fecha_fin;
            $this->save();
        }

        return $resuelto;
    }

    public function agregarTratamiento( Tratamiento $tratamiento, & $mensaje_error)
    {
        return DB::transaction( function() use ($tratamiento, & $mensaje_error) {

            $tratamiento = $this->tratamientos()->updateOrCreate(
                ['tratamiento_id' => $tratamiento->id],
                ['importe' => $tratamiento->importe]
            );

            return $tratamiento;
        });
    }

    public function quitarTratamiento( Tratamiento $tratamiento, & $mensaje_error)
    {
        $resuelto = true;
        
        $tratamiento = $this->tratamientos->where('tratamiento_id',$tratamiento->id)->first();
        if ($tratamiento) {
            $resuelto = $tratamiento->dropThis($mensaje_error);
        }

        return $resuelto;
    }

    public function validarFechasVsAgenda( & $mensaje_error) 
    {
        $valida = true;

        if ($this->agenda->fecha_inicio->le($this->fecha_inicio)) {

            if ($this->agenda->fecha_fin->ge($this->fecha_fin)) {

                if (( ! $this->agenda->acepta_sobreturnos) && ($this->turnos_solapados->count() > 0)) {

                    $valida = false;
                    $mensaje_error = 'El turnos se solapa con otros y la agenda no admite sobreturnos.';
                }
            } else {
                $valida = false;
                $mensaje_error = 'El turno no puede finalizar luego de la hora de cierre asignada a la agenda ' . $this->agenda->fecha_fin->format('d-m-Y H:i') . '.';
            }
        } else {
            $valida = false;
            $mensaje_error = 'El turno no puede comenzar antes de la hora de inicio asignada a la agenda ' . $this->agenda->fecha_inicio->format('d-m-Y H:i') . '.';
        }
    }
    # =============================================================================================
}
