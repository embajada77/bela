<?php

namespace App;

use DB;

class Contacto extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contactos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'principal',
    	'publicidad',
    	'contactable_type',
    	'contactable_id',
    	'persona_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
        public function persona() 
        {
            return $this->belongsTo('App\Persona','persona_id','id');
        }

        public function contactable()
	    {
	        return $this->morphTo();
	    }
    # =============================================================================================

    # =============================================================================================
        public function getCanDropThisAttribute()
        {
            return true;
        }
    # =============================================================================================
}
