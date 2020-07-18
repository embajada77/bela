<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
// use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable;
    // use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
    public function getHabilitadoAttribute()
    {
        return true;
    }

    public function isSuperAdmin()
    {
        return $this->isAn('owner');
    }

    public function isAn($rol = 'user')
    {
        switch ($rol) {
            case 'owner':
                return ($this->name === 'xowner');
                break;

            case 'admin':
                return ($this->isAn('owner') || ($this->name === 'admin'));
                break;

            case 'organizer':
                return ($this->name === 'owner');
                break;
            
            default:
                # code...
                break;
        }
    }

    // public function getIsAdminAttribute()
    // {
    //     return ($this->is_owner || ($this->name === 'admin'));
    //     // return $this->isAn('admin');
    // }

    // public function getIsOwnerAttribute()
    // {
    //     // return $this->name === 'xowner';
    //     return $this->name === 'owner';
    //     // return $this->isAn('owner');
    // }
    # =============================================================================================

    # === QUERYS ==================================================================================
    public function owns( Model $model, $foreign_key = 'user_id')
    {
        return $this->id === $model->$foreign_key;
    }

    public function centroAutorizado( ?Centro $centro)
    {
        if (is_null($centro)) {
            return false;
        }

        return ($this->centro) ? ($this->centro->id == $centro->id) : false;
    }
    # =============================================================================================
}
