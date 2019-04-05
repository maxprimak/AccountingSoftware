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

Route::prefix('users')->group(function() {
    Route::get('/', 'UsersController@index');
});


//employees
Route::prefix('employees')->group(function() {
    Route::get('/', 'EmployeesController@index');
});

Route::post('/employees', 'EmployeesController@edit');
