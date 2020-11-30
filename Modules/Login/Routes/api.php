<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Login\Http\Controllers\AuthController;

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

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');
    Route::get('login/google', [AuthController::class, 'redirectToProvider']);
    Route::get('login/google/callback', [AuthController::class, 'handleProviderCallback']);
    Route::post('logout', 'AuthController@logout')->name('logout');
});
Route::get('email/verify/{id}', 'VerificationApiController@verify')->name('verification.verify');
//Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
