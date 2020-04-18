<?php
//Configuración bases de datos

Route::post('/auth/login', 'Jwt\TokensController@login');
Route::post('/auth/refresh', 'Jwt\TokensController@refreshToken');
Route::get('/auth/logout', 'Jwt\TokensController@logout');

// Perfiles
Route::get('profiles/datatable', 'Security\ProfileController@dataTable');
Route::get('profiles/dependences', 'Security\ProfileController@dependences');
Route::apiResource('profiles', 'Security\ProfileController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

Route::get('users/datatable', 'Security\UserController@dataTable');
Route::get('users/dependences', 'Security\UserController@dependences');
Route::apiResource('users', 'Security\UserController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);