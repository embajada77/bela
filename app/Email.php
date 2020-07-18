<?php

namespace App;

class Email extends Contactable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    # === FOREING KEYS ============================================================================
    # =============================================================================================
    
    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        public function getEmailAttribute($attribute)
        {
            return mb_strtolower($attribute);
        }

        public function getContactableNameAttribute()
        {
            return $this->email;
        }

        public function getContactableIconAttribute()
        {
            return 'glyphicon glyphicon-envelope';
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public static function firstOrCreateFromRequest($request)
        {
            $email = null;

            $address = trim($request['email']);
            
            if ($address != "") {
                $email = Email::firstOrCreate([
                    'email' => $address
                ]);
            }

            return $email;
        }
    # =============================================================================================
}
