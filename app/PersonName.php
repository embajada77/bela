<?php

namespace App;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Responsable;
use App\Casts\PersonName as PersonNameCast;
use Illuminate\Support\Str;

class PersonName implements Castable, Responsable
{
    public $name;
    public $surname;

    public function __construct($surname, $name)
    {
        $this->name = trim($name);
        $this->surname = trim($surname);
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array  $arguments
     * @return string
     */
    public static function castUsing()
    {
        return PersonNameCast::class;
    }

    public function toResponse($request)
    {
        return $this->format();
    }

    public function format($format = null)
    {
        switch ($format) {
            case 'name':
                return $this->name;
                break;

            case 'name-reduced':
                return $this->reducedName();
                break;

            case 'name-abbr':
                return $this->abbrName();
                break;

            case 'surname':
                return $this->surname;
                break;

            case 'surname-reduced':
                return $this->reducedSurname();
                break;

            case 'surname-abbr':
                return $this->abbrSurname();
                break;
                
            case 'full':
                return $this->full();
                break;
                
            case 'abbr':
                return $this->abbr();
                break;

            case 'reduced':
                return $this->reduced();
                break;
                
            case 'full-inverse':
                return $this->fullInverse();
                break;
                
            case 'abbr-inverse':
                return $this->abbrInverse();
                break;

            case 'reduced-inverse':
                return $this->reducedInverse();
                break;
                
            default:
                return $this->full();
                break;
        }
    }

    protected function abbrName() 
    {
        return $this->abbrIt($this->name);
    }

    protected function abbrSurname() 
    {
        return $this->abbrIt($this->surname);
    }

    protected function reducedName() 
    {
        return $this->reducedIt($this->name);
    }

    protected function reducedSurname() 
    {
        return $this->reducedIt($this->surname);
    }

    protected function full($conector = ' ') 
    {
        return $this->concat(
            $this->name,
            $this->surname,
            $conector
        );
    }

    protected function abbr($conector = ' ') 
    {
        return $this->concat(
            $this->abbrName(),
            $this->abbrSurname(),
            $conector
        );
    }

    protected function reduced($conector = ' ') 
    {
        return $this->concat(
            $this->reducedName(),
            $this->reducedSurname(),
            $conector
        );
    }

    protected function fullInverse($conector = ', ') 
    {
        return $this->inverseIt(
            $this->name,
            $this->surname,
            $conector
        );
    }

    protected function abbrInverse($conector = ', ') 
    {
        return $this->inverseIt(
            $this->abbrName(),
            $this->abbrSurname(),
            $conector
        );
    }

    protected function reducedInverse($conector = ', ') 
    {
        return $this->inverseIt(
            $this->reducedName(),
            $this->reducedSurname(),
            $conector
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers functions
    |--------------------------------------------------------------------------
    |
    */

    protected function abbrIt($phrase = '') 
    {
        return firstWordThenAbbr($phrase);
    }

    protected function reducedIt($phrase = '') 
    {
        $words = explode(' ',$phrase);

        return trim($words[0]);
    }

    protected function inverseIt($first_phrase = '', $last_phrase = '', $conector = ', ') 
    {
        return $this->concat($last_phrase, $first_phrase, $conector);
    }

    protected function concat($first_phrase = '', $last_phrase = '', $conector = ' ') 
    {
        $first_phrase = trim($first_phrase);

        $last_phrase = trim($last_phrase);

        if ((strlen($first_phrase) == 0) || (strlen($last_phrase) == 0)) {
            $conector = '';
        }

        return $first_phrase . $conector . $last_phrase;
    }
}