<?php

require __DIR__ . '/web/geo.php';

Route::resource('/personas','PersonaController',['names' => [
    'index' => 'personas.index',
    'create' => 'personas.create',
    'update' => 'personas.update',
    'show' => 'personas.show',
    'edit' => 'personas.edit',
    'store' => 'personas.store',
    'destroy' => 'personas.destroy',
]])->parameters([
    'personas' => 'persona'
]);