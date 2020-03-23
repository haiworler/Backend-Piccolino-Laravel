<?php
//Configuración bases de datos

Route::get('headquarters/datatable', 'Schools\HeadquarterController@dataTable');
Route::get('headquarters/dependences', 'Schools\HeadquarterController@dependences');
Route::apiResource('headquarters', 'Schools\HeadquarterController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);