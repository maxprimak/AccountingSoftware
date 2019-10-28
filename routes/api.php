<?php

use Illuminate\Http\Request;

use Modules\Login\Http\Controllers\LoginController;

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

Route::middleware('is_authorized')->get('/user', function (Request $request) {
   return auth('api')->user();
})->name('user');
