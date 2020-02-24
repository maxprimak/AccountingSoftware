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

Route::middleware(['is_authorized','is_registered'])->group(function () {

    Route::get('/suppliers', 'SuppliersController@index')->name('suppliers.index');
    Route::post('/suppliers', 'SuppliersController@store')->name('suppliers.store');
    Route::post('/suppliers/{supplier_id}', 'SuppliersController@update')->name('suppliers.update');
    Route::delete('/suppliers/{supplier_id}', 'SuppliersController@destroy')->name('suppliers.destroy');

    Route::post('/orders/suppliers/email', 'SupplierOrderNotificationsController@email')->name('orders.suppliers.email');

    //NOTE: needs facebook business verification to use twilio
    //Route::post('/orders/suppliers/whatsapp', 'SupplierOrderNotificationsController@whatsapp')->name('orders.suppliers.whatsapp');

});