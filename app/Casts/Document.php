<?php

namespace App\Casts;

use App\Document as DocumentValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class Document implements CastsAttributes
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
    	return new DocumentValueObject(
    		$attributes['documento'],
    		$model->tipo_documento
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
        if ( ! $value instanceof DocumentValueObject) {
            throw new InvalidArgumentException('The given value is not a valid instance.');
        }

    	return [
    		'tipo_documento_id' => $value->type->id,
    		'documento' => $value->number
    	];
    }
}