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
    Route::get('/suppliers/orders', 'SupplierOrdersController@index')->name('orders.repair.index');
    Route::post('/suppliers/orders', 'SupplierOrdersController@store')->name('supplier.orders.store');
});