<?php
//Configuración bases de datos

Route::post('/auth/login', 'Jwt\TokensController@login');
Route::post('/auth/refresh', 'Jwt\TokensController@refreshToken');
Route::get('/auth/logout', 'Jwt\TokensController@logout');
