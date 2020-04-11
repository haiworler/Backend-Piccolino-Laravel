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
// Asignaturas
Route::get('subjects/datatable', 'Schools\SubjectController@dataTable');
Route::get('subjects/getTeachers', 'Schools\SubjectController@getTeachers');
Route::post('subjects/assignTeacher/{subject_id}', 'Schools\SubjectController@assignTeacher');

Route::apiResource('subjects', 'Schools\SubjectController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);
//Competencias

Route::apiResource('competencies', 'Schools\CompetencieController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);