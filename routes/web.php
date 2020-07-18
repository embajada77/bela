<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::catch(function(){
	
// 	# El metodo catch fue creado por nosotros el RouteServiceProvider
// 	# y nos permite redirigir cualquier url inválida a un error,
// 	# ya sea porque el usuario no tiene acceso o porque la url no existe.

// 	throw new NotFoundHttpException('No encontre nada papu.');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/agendas','AgendaController',['names' => [
    'index' => 'agendas.index',
    'create' => 'agendas.create',
    'update' => 'agendas.update',
    'show' => 'agendas.show',
    'edit' => 'agendas.edit',
    'store' => 'agendas.store',
    'destroy' => 'agendas.destroy',
]])->parameters([
    'agendas' => 'agenda'
])->middleware('auth');

Route::resource('/turnos','TurnoController',['names' => [
    'index' => 'turnos.index',
    'create' => 'turnos.create',
    'update' => 'turnos.update',
    'show' => 'turnos.show',
    'edit' => 'turnos.edit',
    'store' => 'turnos.store',
    'destroy' => 'turnos.destroy',
]])->parameters([
    'turnos' => 'turno'
])->middleware('auth');