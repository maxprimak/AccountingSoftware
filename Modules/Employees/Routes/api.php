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
Route::middleware(['is_authorized', 'is_registered'])->group(function () {

    Route::get('employees', 'EmployeesController@index')->name('employees.index');
    Route::post('employees', 'EmployeesController@store')->name('employees.store');
    Route::post('employees/{employee_id}', 'EmployeesController@update')->name('employees.update');
    Route::delete('employees/{employee_id}', 'EmployeesController@destroy')->name('employees.destroy');

    Route::get('roles', 'RolesController@index')->name('roles.index');

});