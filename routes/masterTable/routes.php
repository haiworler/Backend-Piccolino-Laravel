<?php
//Configuración bases de datos

Route::get('neighborhoods/datatable', 'MasterTables\NeighborhoodController@dataTable');
Route::get('neighborhoods/dependences', 'MasterTables\NeighborhoodController@dependences');
Route::apiResource('neighborhoods', 'MasterTables\NeighborhoodController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);