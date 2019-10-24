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

Route::middleware(['auth', 'admin', 'is_registered'])->group(function () {
    // Route::resource('/employees', 'EmployeesController');

    //Employees
    Route::get('/employees', 'EmployeesController@index');
    Route::post('/employees', 'EmployeesController@store');
    Route::get('/employees/create', 'EmployeesController@create');
    Route::post('/employees/{employee_id}', 'EmployeesController@update');
    Route::delete('/employees/{employee_id}', 'EmployeesController@destroy');
});
