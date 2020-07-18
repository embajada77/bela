<?php

namespace App;

class TipoTelefono extends BaseModel
{
	const CELULAR = 1;
	const FIJO = 2;
	const SKYPE = 3;
	const TRABAJO = 4;
	const FAX = 5;
	const OTRO = 6;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipos_telefonos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre', 
        'alias', 
        'descripcion'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
    public function telefonos()
    {
        return $this->hasMany('App\Telefono','tipo_telefono_id','id');
    }
    # =============================================================================================

    # === MUTATORS ================================================================================
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
    public function getFullNameAttribute() 
    {
        return ucwords($this->nombre);
    }

    public function getIconoAttribute()
    {
        switch ($this->id) {
            case TipoTelefono::CELULAR:
                $icono = 'glyphicon glyphicon-phone';
                break;
            case TipoTelefono::FIJO:
                $icono = 'glyphicon glyphicon-phone-alt';
                break;
            case TipoTelefono::SKYPE:
                $icono = 'fa fa-skype';
                break;
            case TipoTelefono::TRABAJO:
                $icono = 'glyphicon glyphicon-earphone';
                break;
            case TipoTelefono::FAX:
                $icono = 'fa fa-fax';
                break;
            default:
                $icono = 'glyphicon glyphicon-earphone';
                break;
        }

        return $icono;
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
        return ($this->telefonos->count() == 0);
    }
    # =============================================================================================
}
