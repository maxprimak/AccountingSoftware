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
    Route::get('/employees', 'EmployeesController@index')->name('employees.index');
    Route::post('/employees', 'EmployeesController@store')->name('employees.store');
    Route::get('/employees/create', 'EmployeesController@create')->name('employees.create');
    Route::post('/employees/{employee_id}', 'EmployeesController@update')->name('employees.update');
    Route::delete('/employees/{employee_id}', 'EmployeesController@destroy')->name('employees.destroy');
});
