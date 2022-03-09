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
    public function getNombreAttribute($attribute)
    {
        return $this->persona ? $this->persona->nombre : '';
    }

    public function getApellidoAttribute($attribute)
    {
        return $this->persona ? $this->persona->apellido : '';
    }

    public function getAbbrNameAttribute() 
    {
        return $this->persona ? $this->persona->abbr_name : '';
    }

    public function getAbbrSurnameAttribute() 
    {
        return $this->persona ? $this->persona->abbr_surname : '';
    }

    public function getFirstNameAttribute() 
    {
        return $this->persona ? $this->persona->first_name : '';
    }

    public function getFirstSurnameAttribute() 
    {
        return $this->persona ? $this->persona->first_surname : '';
    }

    public function getFullNameAttribute() 
    {
        return $this->persona ? $this->persona->full_name : '';
    }

    public function getMinimalNameAttribute() 
    {
        return $this->persona ? $this->persona->minimal_name : '';
    }

    public function getReduceNameAttribute() 
    {
        return $this->persona ? $this->persona->reduce_name : '';
    }

    public function getInverseFullNameAttribute() 
    {
        return $this->persona ? $this->persona->inverse_full_name : '';
    }

    public function getInverseMinimalNameAttribute() 
    {
        return $this->persona ? $this->persona->inverse_minimal_name : '';
    }

    public function getInverseReduceNameAttribute() 
    {
        return $this->persona ? $this->persona->inverse_reduce_name : '';
    }

    public function attrPersona($attr=null) 
    {
        if ($attr) {
            return $this->persona ? $this->persona->$attr : null;
        }
    }
    # =============================================================================================
}
