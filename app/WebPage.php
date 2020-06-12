<?php

namespace App;

class WebPage extends Contactable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url'
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
        public function getUrlAttribute($attribute)
        {
            return mb_strtolower($attribute);
        }

        public function getContactableNameAttribute()
        {
            return $this->url;
        }

        public function getContactableIconAttribute()
        {
            return 'glyphicon glyphicon-globe';
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        public static function firstOrCreateFromRequest($request)
        {
            $web_page = null;

            $url = trim($request['url']);
            
            if ($url != "") {
                $web_page = WebPage::firstOrCreate([
                    'url' => $url
                ]);
            }

            return $web_page;
        }
    # =============================================================================================
}