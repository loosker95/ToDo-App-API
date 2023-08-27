<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route with group
//Route::controller(TasksController::class)->group(function(){
//    Route::get('/tasks', 'index');
//    Route::post('/tasks', 'store');
//    Route::put('/tasks/{id}', 'update');
//});

Route::resource('tasks', TasksController::class)->only([
    'index', 'store', 'show', 'edit', 'update', 'destroy'
]);

//Or each Route separately
//Route::post('/tasks', [TasksController::class, 'addTasks']);
//Route::get('/all', [TasksController::class, 'getTasks']);
//Route::put('/tasks/{id}', [TasksController::class, 'updateTasks']);


