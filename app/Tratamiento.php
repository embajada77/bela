<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'tratamientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre',
		'alias',
		'descripcion',
		'habilitado',
		'duracion',
		'importe',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [
    	'duracion'
    ];
    
    # === FOREING KEYS ============================================================================
    public function getFullNameAttribute()
    {
	    return specialUcwords($this->nombre);
    }
    # =============================================================================================
}
