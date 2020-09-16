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

// Paises
Route::get('countries/datatable', 'MasterTables\CountryController@dataTable');
Route::get('countries/towns/{country_id}', 'MasterTables\CountryController@towns');
Route::get('countries/departments/{country_id}', 'MasterTables\CountryController@departments');
Route::apiResource('countries', 'MasterTables\CountryController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Departamentos
Route::get('departments/datatable', 'MasterTables\DepartmentController@dataTable');
Route::get('departments/areas/{department_id}', 'MasterTables\DepartmentController@areas');
Route::get('departments/dependences', 'MasterTables\DepartmentController@dependences');
Route::apiResource('departments', 'MasterTables\DepartmentController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Ciudades
Route::get('towns/datatable', 'MasterTables\TownController@dataTable');
Route::get('towns/dependences', 'MasterTables\TownController@dependences');
Route::get('towns/departments/{id}', 'MasterTables\TownController@departments');
Route::apiResource('towns', 'MasterTables\TownController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

//Localidades

Route::get('localities/datatable', 'MasterTables\LocalityController@dataTable');
Route::get('localities/dependences', 'MasterTables\LocalityController@dependences');
Route::apiResource('localities', 'MasterTables\LocalityController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);


// Documentos de identificación

Route::get('typeDocuments/datatable', 'MasterTables\TypeDocumentController@dataTable');
Route::apiResource('typeDocuments', 'MasterTables\TypeDocumentController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Ocupaciones de la persona

Route::get('occupations/datatable', 'MasterTables\OccupationController@dataTable');
Route::apiResource('occupations', 'MasterTables\OccupationController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);