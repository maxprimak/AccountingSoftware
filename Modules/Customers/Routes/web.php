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
Route::middleware(['auth', 'employee', 'is_registered'])->group(function () {
    Route::get('/customers', 'CustomersController@index')->name('customers.index');
    Route::get('/customers/create', 'CustomersController@create')->name('customers.create');
    Route::post('customers/set_stars_number/{customer_id}', 'StarsNumberController@store')->name('set.stars.number');
    Route::post('/customers', 'CustomersController@store')->name('customers.store');
    Route::post('/customers/{customer_id}', 'CustomersController@update')->name('customers.update');
    Route::delete('/customers/{customer_id}', 'CustomersController@destroy')->name('customers.destroy');
});
