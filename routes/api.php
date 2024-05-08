<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TimesheetController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}/update', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['prefix' => 'project'], function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::put('/{id}/update', [ProjectController::class, 'update']);
        Route::delete('/{id}', [ProjectController::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'timesheet'], function () {
        Route::get('/', [TimesheetController::class, 'index']);
        Route::post('/', [TimesheetController::class, 'store']);
        Route::get('/{id}', [TimesheetController::class, 'show']);
        Route::put('/{id}/update', [TimesheetController::class, 'update']);
        Route::delete('/{id}', [TimesheetController::class, 'destroy']);
    });
});
