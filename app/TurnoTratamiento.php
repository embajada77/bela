<?php

namespace App;

use DB;

class TurnoTratamiento extends BaseModel
{
    protected $table = 'turnos_tratamientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'importe',
		'comision_centro',
		'tratamiento_id',
		'turno_id',
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

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class,'tratamiento_id','id');
    }

    public function responsables()
    {
        return $this->hasMany(TurnoResponsable::class,'turno_tratamiento_id','id');
    }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getDuracionAttribute()
    {
    	// return $this->tratamiento ? $this->tratamiento->duracion : Carbon::createMidnightDate()->format('H:i:s');
    	return $this->tratamiento ? $this->tratamiento->duracion : '00:00:00';
    }

    public function getFullNameAttribute()
    {
		return $this->tratamiento ? $this->tratamiento->full_name : '';
    }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
    public function agregarResponsable( Empleado $empleado, & $mensaje_error)
    {
        return $this->responsables()->create([
            'empleado_id' => $empleado->id,
            'comision' => $empleado->comision_tratamiento,
        ]);
    }

    public function quitarResponsable( Empleado $empleado, & $mensaje_error)
    {
        $resuelto = true;

        $responsable = $this->responsables->where('empleado_id',$empleado->id)->first();
        if ($responsable) {
            $resuelto = $responsable->dropThis($mensaje_error);
        }

        return $resuelto;
    }

    public function getCanDropThisAttribute()
    {
        return true;
    }

    protected function dropRelationships( & $mensaje_error, bool $force = false)
    {
        return DB::transaction( function() use ($mensaje_error,$force) {
        
            $resuelto = true;

            foreach ($this->responsables as $responsable) {
                if ( ! $resuelto) { break; }

                $resuelto = $responsable->dropThis($mensaje_error,$force);
            }

            if ( ! $resuelto) {
                DB::rollback();
            }

            return $resuelto;
        });
    }
    # =============================================================================================
}
