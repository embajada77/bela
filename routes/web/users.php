<?php

Route::resource('/users','UserController',['names' => [
    'index' => 'users.index',
    'create' => 'users.create',
    'update' => 'users.update',
    'show' => 'users.show',
    'edit' => 'users.edit',
    'store' => 'users.store',
    'destroy' => 'users.destroy',
]])->parameters([
    'users' => 'user'
]);
