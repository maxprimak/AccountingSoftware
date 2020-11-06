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

    Route::get('/suppliers/orders/{supplier_id}/supplier', 'SupplierHasOrdersController@show')->name('suppliers.orders.show.supplier');

    Route::post('/orders/suppliers/email', 'SupplierOrderNotificationsController@email')->name('orders.suppliers.email');

    Route::get('/suppliers/orders/', 'SupplierOrdersController@index')->name('suppliers.orders.index');
    Route::post('/suppliers/orders/store', 'SupplierOrdersController@store')->name('suppliers.orders.store');
    Route::post('/suppliers/orders/{supplier_order_id}/update', 'SupplierOrdersController@update')->name('suppliers.orders.update');
    Route::delete('/suppliers/orders/{supplier_order_id}/destroy', 'SupplierOrdersController@destroy')->name('suppliers.orders.destroy');

    Route::get('/goods/{supplier_order_id}/suppliers/orders', 'SupplierOrderHasGoodsController@index')->name('goods.index.suppliers.orders');

    Route::get('/suppliers/orders/statuses', 'SupplierOrdersStatusesController@index')->name('suppliers.orders.statuses.index');
    Route::get('/suppliers/orders/id', 'SupplierOrdersNumbersController@index')->name('suppliers.orders.number.index');

    Route::post('/suppliers/orders/goods/to_stock/{supplier_order_id}', 'AddSupplierGoodsToStockController@update')->name('suppliers.orders.to_stock.update');

    Route::post('/suppliers/orders/{order_id}/paid', 'SupplierOrderPaymentController@store')->name('suppliers.orders.paid.store');
    //NOTE: needs facebook business verification to use twilio
    //Route::post('/orders/suppliers/whatsapp', 'SuplierOrderNotificationsController@whatsapp')->name('orders.suppliers.whatsapp');

});
