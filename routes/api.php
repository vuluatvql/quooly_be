<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ContactController;
use App\Http\Controllers\Api\User\RegisterController;
use App\Http\Controllers\Api\User\ForgotPasswordController;
use App\Http\Controllers\Api\User\ResetPasswordController;
use App\Http\Controllers\Api\User\FavoriesController;
use App\Http\Controllers\Api\User\MailSettingController;
use App\Http\Controllers\Api\User\ViewHistoryController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\RequestController;
use App\Http\Controllers\Api\ChangePasswordController;
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
    // 'namespace' => 'User',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::resource('contact', ContactController::class);
    Route::resource('register', RegisterController::class);
    Route::resource('forgot-password', ForgotPasswordController::class);
    Route::resource('reset-password', ResetPasswordController::class);


    Route::group([
        'middleware' => ['jwt.verify', 'auth.jwt'],
    ], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::resource('favorites', FavoriesController::class);
        Route::resource('view-history', ViewHistoryController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('request', RequestController::class);
        Route::resource('change-password', ChangePasswordController::class);
        Route::resource('mail-setting', MailSettingController::class);
    });
});
