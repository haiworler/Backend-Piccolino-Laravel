<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
include_once __DIR__ . '/security/routes.php';
include_once __DIR__ . '/masterTable/routes.php';
include_once __DIR__ . '/schools/routes.php';
include_once __DIR__ . '/people/routes.php';


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Jwt
 */
Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'v1'], function() {
  Route::get('/auth/lucho','Jwt\TokensController@lucho');
});


