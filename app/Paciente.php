<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

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

    public function turnos()
    {
        return $this->hasMany(Turno::class,'paciente_id','id');
    }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getFullNameAttribute()
    {
    	return $this->persona ? $this->persona->full_name : '';
    }
    # =============================================================================================
}
