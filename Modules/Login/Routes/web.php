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

//TODO: Understand why routes do not work here
Route::prefix('login')->group(function() {
    Route::get('/', 'LoginController@index');
});

//Add new routes here
Route::get('/login', 'LoginController@index');