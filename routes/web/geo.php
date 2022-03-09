<?php

Route::get('/search/localidades',[
    'as'    => 'geo.localidades.search',
    'uses'  => 'Geo\LocalidadController@search'
]);

Route::group(['prefix' => 'geo', 'middleware' => ['auth', 'owner']], function () {

    Route::resource('/paises','Geo\PaisController',['names' => [
        'index' => 'geo.paises.index',
        'create' => 'geo.paises.create',
        'update' => 'geo.paises.update',
        'show' => 'geo.paises.show',
        'edit' => 'geo.paises.edit',
        'store' => 'geo.paises.store',
        'destroy' => 'geo.paises.destroy',
    ]])->parameters([
        'paises' => 'pais'
    ]);

	Route::group(['prefix' => 'paises'], function () {

        Route::get('/{id}/localidades', function ($id) {
            return response()->json([
                'result' => json_response_ok(), 
                'response' => Localidad::listByFullName($id) 
            ]);
        })->name('geo.paises.localidades');
	});

    Route::resource('/provincias','Geo\ProvinciaController',['names' => [
        'index' => 'geo.provincias.index',
        'create' => 'geo.provincias.create',
        'update' => 'geo.provincias.update',
        'show' => 'geo.provincias.show',
        'edit' => 'geo.provincias.edit',
        'store' => 'geo.provincias.store',
        'destroy' => 'geo.provincias.destroy',
    ]])->parameters([
        'provincias' => 'provincia'
    ]);

    Route::resource('/distritos','Geo\DistritoController',['names' => [
        'index' => 'geo.distritos.index',
        'create' => 'geo.distritos.create',
        'update' => 'geo.distritos.update',
        'show' => 'geo.distritos.show',
        'edit' => 'geo.distritos.edit',
        'store' => 'geo.distritos.store',
        'destroy' => 'geo.distritos.destroy',
    ]])->parameters([
        'distritos' => 'distrito'
    ]);

    Route::resource('/localidades','Geo\LocalidadController',['names' => [
        'index' => 'geo.localidades.index',
        'create' => 'geo.localidades.create',
        'update' => 'geo.localidades.update',
        'edit' => 'geo.localidades.edit',
        'store' => 'geo.localidades.store',
        'show' => 'geo.localidades.show',
        'destroy' => 'geo.localidades.destroy',
    ]])->parameters([
        'localidades' => 'localidad'
    ]);

    Route::resource('/calles','Geo\CalleController',['names' => [
        'index' => 'geo.calles.index',
        'create' => 'geo.calles.create',
        'update' => 'geo.calles.update',
        'edit' => 'geo.calles.edit',
        'store' => 'geo.calles.store',
        'show' => 'geo.calles.show',
        'destroy' => 'geo.calles.destroy',
    ]])->parameters([
        'calles' => 'calle'
    ]);

    Route::resource('/domicilios','Geo\DomicilioController',['names' => [
        'index' => 'geo.domicilios.index',
        'create' => 'geo.domicilios.create',
        'update' => 'geo.domicilios.update',
        'edit' => 'geo.domicilios.edit',
        'store' => 'geo.domicilios.store',
        'show' => 'geo.domicilios.show',
        'destroy' => 'geo.domicilios.destroy',
    ]])->parameters([
        'domicilios' => 'domicilio'
    ]);
});