<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('tasks/{id}/finish', 'TaskController@finish');
Route::put('tasks/{id}/restore-finished', 'TaskController@restoreFinished');
Route::put('tasks/{id}/restore-deleted', 'TaskController@restoreDeleted');
Route::get('finished-tasks', 'TaskController@finishedTasks');
Route::apiResource('tasks', 'TaskController');
