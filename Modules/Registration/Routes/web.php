<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'is_not_registered'])->group(function () {

    Route::get('/registration', 'RegistrationController@index')->name('registration.index');
    Route::post('/registration', 'RegistrationController@store')->name('registration.store');

});
