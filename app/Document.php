<?php

namespace App;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Responsable;
use App\Casts\Document as DocumentCast;

class Document implements Castable, Responsable
{
    public $number;
    public $type;

    public function __construct($number, $type)
    {
        $this->number = $number;

        $this->type = $type;
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array  $arguments
     * @return string
     */
    public static function castUsing()
    {
        return DocumentCast::class;
    }

    public function toResponse($request)
    {
        return $this->format();
    }

    public function format($format = null)
    {
        switch ($format) {
            case 'number':
                return $this->number;
                break;
                
            case 'masked':
                return $this->masked();
                break;
                
            case 'full':
                return $this->full(false);
                break;
                
            case 'full-masked':
                return $this->full();
                break;
                
            default:
                return $this->full();
                break;
        }
    }

    protected function full($masked = true)
    {
        return (strlen($this->number))
            ? trim($this->typeAlias() . ' ' . $this->masked($masked))
            : '';
    }

    protected function masked($masked = true)
    {
        if ( ! $masked) {

            return $this->number;
        }

        $preg_match = $this->typePregMatch();
        $preg_replace = $this->typePregReplace();

        if ((strlen($preg_match) == 0) || (strlen($preg_replace) == 0)) {

            return $this->number;
        }

        if (preg_match($preg_match,$this->number)) {

            return preg_replace($preg_match,$preg_replace,$this->number);
        }

        return $this->number;
    }

    public function typeAlias() 
    {
        return ($this->type) 
            ? $this->type->alias 
            : '';
    }

    public function typePregMatch() 
    {
        return ($this->type) 
            ? $this->type->preg_match 
            : '';
    }

    public function typePregReplace() 
    {
        return ($this->type) 
            ? $this->type->preg_replace 
            : '';
    }

    public function pais() 
    {
        return ($this->type) 
            ? $this->type->pais 
            : null;
    }

    public function paisId() 
    {
        return ($this->type) 
            ? $this->type->pais_id 
            : null;
    }

    public function nacionalidad() 
    {
        return ($this->pais()) 
            ? $this->pais()->nombre 
            : '';
    }
}