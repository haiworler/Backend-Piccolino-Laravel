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
// Semestres
Route::get('semesters/datatable', 'Schools\SemesterController@dataTable');
Route::get('semesters/dependences', 'Schools\SemesterController@dependences');
Route::apiResource('semesters', 'Schools\SemesterController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Grados
Route::get('grades/datatable', 'MasterTables\GradeController@dataTable');
Route::apiResource('grades', 'MasterTables\GradeController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);
// Matrículas
Route::get('enrolleds/getStudent', 'Schools\EnrolledController@getStudent');
Route::get('enrolleds/datatable', 'Schools\EnrolledController@dataTable');
Route::get('enrolleds/dependences', 'Schools\EnrolledController@dependences');
Route::apiResource('enrolleds', 'Schools\EnrolledController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Grupos
Route::get('groups/datatable', 'Schools\GroupController@dataTable');
Route::get('groups/dependences', 'Schools\GroupController@dependences');
Route::get('groups/getTeacher', 'Schools\GroupController@getTeacher');
// Estudiantes del grupo
Route::get('groups/groupStudentList/{group_id}', 'Schools\GroupController@groupStudentList');
Route::post('groups/removeStudent/{group_id}', 'Schools\GroupController@removeStudent');
Route::post('groups/studentList/{group_id}', 'Schools\GroupController@studentList');
Route::post('groups/assignStudentsGroup', 'Schools\GroupController@assignStudentsGroup');
// Asignaturas del grupo
Route::get('groups/subjectStudentList/{group_id}', 'Schools\GroupController@subjectStudentList');
Route::post('groups/removeSubject/{group_id}', 'Schools\GroupController@removeSubject');
Route::post('groups/subjectList', 'Schools\GroupController@subjectList');
Route::post('groups/assignSubjectsGroup', 'Schools\GroupController@assignSubjectsGroup');
// Horario del grupo
Route::get('groups/groupScheduleList/{group_id}', 'Schools\GroupController@groupScheduleList');
Route::get('groups/getSubjectTeacher/{subject_id}', 'Schools\GroupController@getSubjectTeacher');


Route::apiResource('groups', 'Schools\GroupController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Cortes
Route::get('cuts/datatable', 'MasterTables\CutController@dataTable');
Route::apiResource('cuts', 'MasterTables\CutController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Horario Día
Route::post('stateScheduleDay/{schedule_day_id}', 'Schools\ScheduleDayController@stateScheduleDay');
Route::apiResource('scheduleDays', 'Schools\ScheduleDayController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);

// Horario Hora
Route::apiResource('scheduleHours', 'Schools\ScheduleHourController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);


// Notas
Route::get('notes/dependences', 'Schools\NoteController@dependences');
Route::get('notes/datatable', 'Schools\NoteController@dataTable');
Route::get('notes/getGroupTeacher', 'Schools\NoteController@getGroupTeacher');
Route::get('notes/getSubjectTeacher', 'Schools\NoteController@getSubjectTeacher');
Route::get('notes/getPeopleGroupNote', 'Schools\NoteController@getPeopleGroupNote');
Route::get('notes/getPeopleGroupNoteUpdate', 'Schools\NoteController@getPeopleGroupNoteUpdate');
Route::apiResource('notes', 'Schools\NoteController', ['only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy',
]]);
