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

Route::middleware(['is_authorized'])->group(function () {
    Route::get('employees', 'EmployeesController@index');
    Route::post('employees', 'EmployeesController@store');
    Route::post('employees/{employee_id}', 'EmployeesController@update');
    Route::delete('employees/{employee_id}', 'EmployeesController@destroy');
});