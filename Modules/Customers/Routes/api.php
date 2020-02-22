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

    Route::get('customers', 'CustomersController@index')->name('customers.index');
    Route::post('customers', 'CustomersController@store')->name('customers.store');
    Route::post('customers/{customer_id}', 'CustomersController@update')->name('customers.update')->middleware('my_customer');
    Route::delete('customers/{customer_id}', 'CustomersController@destroy')->name('customers.destroy')->middleware('my_customer');

    Route::post('customers/set_stars_number/{customer_id}', 'StarsNumberController@store')->name('set.stars.number')->middleware('my_customer');

    Route::get('customer_types', 'CustomerTypesController@index')->name('customer_types.index');

    //update regular customer
    Route::get('regular_customers/{customer_id}', 'RegularCustomerController@update')->name('regular_customers.update')->middleware('my_customer');
});
