<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PassportAuthController;

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

Route::group(['prefix' => 'v1'], function () {
    Route::post('social_signup', [PassportAuthController::class, 'social_signup']);
    Route::post('signup', [PassportAuthController::class, 'signup']);
    Route::post('login', [PassportAuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('change_password', [PassportAuthController::class, 'change_password']);
    });
});