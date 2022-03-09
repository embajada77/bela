<?php

namespace App\Casts;

use App\PersonName as PersonNameValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class PersonName implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new PersonNameValueObject(
            $attributes['apellido'],
            $attributes['nombre']
        );
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ( ! $value instanceof PersonNameValueObject) {
            throw new InvalidArgumentException('The given value is not a valid instance.');
        }

        return [
            'apellido' => trim($value->surname),
            'nombre' => trim($value->name)
        ];
    }
}