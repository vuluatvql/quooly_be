<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ContactController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ViewHistoryController;
use App\Http\Controllers\Api\FavoriesController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ProfileController;
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
    'prefix' => 'v1/user',
    'namespace' => 'User',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::resource('contact', ContactController::class);

    Route::resource('user', UserController::class);
    Route::resource('forgot-password', ForgotPasswordController::class);
    Route::resource('reset-password', ResetPasswordController::class);

    Route::group([
        'middleware' => ['jwt.verify', 'auth.jwt'],
    ], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::resource('favorites', FavoriesController::class);
        Route::resource('view-history', ViewHistoryController::class);
        Route::resource('profile', ProfileController::class);

    });
});
// Route::group([
//     'middleware' => ['assign.guard:api'],
//     'prefix' => 'v1/user',
// ], function () {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::resource('contact', ContactController::class);
//     Route::resource('user', UserController::class);
//     Route::resource('forgot-password', ForgotPasswordController::class);
//     Route::resource('reset-password', ResetPasswordController::class);

//     Route::group([
//         'middleware' => ['jwt.verify', 'auth.jwt'],
//     ], function () {
//         Route::resource('favorites', FavoriesController::class);
//         Route::post('logout', [AuthController::class, 'logout']);
//         Route::resource('view-history', ViewHistoryController::class);
//     });
// });
