<?php

namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;

class Agenda extends BaseModel
{
    protected $table = 'agendas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'habilitado',
		'fecha_inicio',
		'fecha_fin',
        
		'plus_diario',
		'comision_diaria',
		'plus_armado_agenda',
		'comision_armado_agenda',

		'estado_id',
		'centro_id',
		'created_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = [
        'fecha_inicio' => 'dateTime',
        'fecha_fin' => 'dateTime',
    ];
    
    # === FOREING KEYS ============================================================================
    public function usuario()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoAgenda::class,'estado_id','id');
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class,'centro_id','id');
    }

    public function turnos()
    {
        return $this->hasMany(Turno::class,'agenda_id','id');
    }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getDiaAttribute()
    {
        return $this->fecha_inicio->format('d-m-Y');
    }

    public function getHoraAttribute()
    {
        return $this->fecha_inicio->format('H:i');
    }

    public function getHoraFinAttribute()
    {
        return $this->fecha_fin->format('H:i');
    }

    public function getDiaFinAttribute()
    {
        return $this->fecha_fin->format('d-m-Y');
    }

    public function getDiasDuracionAttribute()
    {
        return $this->fecha_fin->diffInDays($this->fecha_inicio);
    }
    # =============================================================================================

    # === QUERYS ==================================================================================
    public function getTurnosOrdenadosAttribute()
    {
    	return $this->turnos
    		->sort( function($item_a,$item_b) {
                return ($this->item_a->fecha_inicio->gt($item_b->fecha_inicio) ? 1 : -1);
            });
    }

    public function getUltimoTurnoAttribute()
    {
    	return $this->turnos_ordenados->last();
    }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
    public function getCanDropThisAttribute()
    {
        return ($this->turnos->count() == 0);
    }

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        return DB::transaction( function() use ($mensaje_error,$force) {

            $resuelto = true;
            
            foreach ($this->turnos as $turno) {
                if ( ! $resuelto) { break; }

                $resuelto = $turno->dropThis($mensaje_error,$force);
            }

            if ( ! $resuelto) {
                DB::rollback();
            }

            return $resuelto;
        });
    }

    public function crearTurno( Paciente $paciente, Carbon $fecha_inicio, Carbon $fecha_fin = null, Collection $tratamientos, & $mensaje_error)
    {
		return DB::transaction( function() use ($paciente,$fecha_inicio,$fecha_fin,$tratamientos, & $mensaje_error) {
            
            $resuelto = true;

	        $turno = $this->turnos()->create([
		    	'fecha_inicio' 	=> $fecha_inicio->format('Y-m-d H:i:s'),
				'estado_id' 	=> EstadoTurno::ACTIVO,
				'paciente_id' 	=> $paciente->id,
				'created_by' 	=> optional(auth()->user())->id,
	    	]);

	    	foreach ($tratamientos as $tratamiento_id) {
                if ( ! $resuelto) { break; }

                $turno_tratamiento = $turno->agregarTratamiento(Tratamiento::find($tratamiento_id),$mensaje_error);

                $resuelto = ( ! is_null($turno_tratamiento));
	    	}

            if ($resuelto) {
                $resuelto = $turno->setFechaFin($fecha_fin,$mensaje_error);
            }
                
            if ($resuelto) {
                $turno->save();
            } else {

                $turno = null;

                DB::rollback();
            }

	    	return $turno;
    	});
    }
    # =============================================================================================
}
