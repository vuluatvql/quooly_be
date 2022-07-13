<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ViewHistoryController;
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
Route::group([
    'middleware' => ['assign.guard:api'],
    'prefix' => 'v1',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('create', [ContactController::class, 'store']);
//    Route::get('contact/{id}', [ContactController::class, 'show']);
//    Route::get('delete/{id}', [ContactController::class, 'destroy']);
    Route::resource('contact', ContactController::class);
    Route::group([
        'middleware' => ['jwt.verify', 'auth.jwt'],
    ], function () {
        Route::get('user_info', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::resource('view_history', ViewHistoryController::class);
    });
});
