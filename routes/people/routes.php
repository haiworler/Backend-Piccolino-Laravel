<?php
//Configuración bases de datos

Route::get('people/datatable', 'People\PeopleController@dataTable');
Route::get('people/dependences', 'People\PeopleController@dependences');
Route::put('people/updatePeople/{id}', 'People\PeopleController@updatePeople');
Route::apiResource('people', 'People\PeopleController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Para los Informes
Route::get('peopleExports', 'People\PeopleController@getPeopleExport');


//Tipos de documentos (Categoria de documentos)
Route::get('categoryDocuments/datatable', 'People\CategoryDocumentController@dataTable');
Route::apiResource('categoryDocuments', 'People\CategoryDocumentController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

//Niveles academicos
Route::get('trainingTypes/datatable', 'People\TrainingTypeController@dataTable');
Route::apiResource('trainingTypes', 'People\TrainingTypeController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);
