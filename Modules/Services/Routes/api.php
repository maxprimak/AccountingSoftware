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

Route::post('/services', 'ServicesController@store')->name('services.store');
Route::post('/services/{service_id}', 'ServicesController@update')->name('services.update');
Route::get('/services', 'ServicesController@index')->name('services.index');
