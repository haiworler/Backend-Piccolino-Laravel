<?php
//Configuración bases de datos

Route::get('people/datatable', 'People\PeopleController@dataTable');
Route::get('people/dependences', 'People\PeopleController@dependences');
Route::apiResource('people', 'People\PeopleController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);