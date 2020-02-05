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
//Repair Orders
Route::post('/orders/repair', 'RepairOrdersController@store')->name('orders.repair.store');
Route::get('/orders/repair/edit/{order_id}', 'RepairOrdersController@show')->name('orders.repair.show')->middleware('my_repair_order');
Route::post('/orders/repair/{order_id}', 'RepairOrdersController@update')->name('orders.repair.update')->middleware('my_repair_order');
Route::get('/orders/repair/branch/{branch_id}/{is_completed}', 'RepairOrdersBranchController@index')->name('orders.repair.branch.index')->middleware('my_branch');
Route::delete('/orders/repair/{repair_order_id}', 'RepairOrdersController@destroy')->name('orders.repair.destroy')->middleware('my_repair_order');
Route::post('/orders/repair/{order_id}/status', 'RepairOrderStatusController@update')->name('repair_orders_status.update')->middleware('my_repair_order');
Route::get('/orders/repair/status', 'RepairOrderStatusController@index')->name('repair_orders_status.index');
Route::post('/orders/repair/deadline/{repair_order_id}', 'RepairOrderDeadlineController@update')->name('orders.repair.deadline.update')->middleware('my_repair_order');

Route::post('/orders/sales', 'SalesOrdersController@store')->name('orders.sales.store');
Route::post('/orders/sales/{order_id}', 'SalesOrdersController@update')->name('orders.sales.update')->middleware('my_sales_order');
Route::get('/orders/sales/branch/{branch_id}', 'SalesOrdersBranchController@index')->name('orders.sales.branch.index')->middleware('my_branch');
Route::delete('/orders/sales/{branch_id}', 'SalesOrdersController@destroy')->name('orders.sales.destroy')->middleware('my_branch');

//warranties

Route::get('/warranties', 'WarrantyController@index')->name('warranties.index');
Route::post('orders/repair/warranties/{repair_order_id}', 'WarrantyOrdersController@update')->name('warranties.update');
Route::post('/warranties', 'WarrantyController@store')->name('warranties.store');

//discount_codes
Route::get('/discount_codes', 'DiscountCodesController@index')->name('discount_codes.index');
Route::post('orders/repair/dicount_codes/{repair_order_id}', 'DiscountCodesOrdersController@update')->name('warranties.update')->middleware('my_repair_order');
Route::post('/discount_codes', 'DiscountCodesController@store')->name('discount_codes.store');

    //payment statuses
    Route::get('/payment_statuses', 'PaymentStatusController@index')->name('payment_statuses.index');

    //Device + Service
    Route::post('/device/{device_id}/services', 'DeviceServicesController@index')->name('device_service.index')->middleware('my_device');
    Route::post('/orders/repair/{device_id}/services', 'DeviceServicesController@update')->name('device_service.update')->middleware('my_device');

//RepairOrdersCompleted
    Route::post('/orders/repair/{order_id}/complete ', 'RepairOrderCompletedController@update')->name('repair_order_complete.update')->middleware('my_repair_order');

//RepairOrderHasGoodsController
    Route::post('/orders/goods/{order_id}', 'RepairOrderHasGoodsController@store')->name('repair_order_has_goods.store')->middleware('my_repair_order');
    Route::post('/orders/repair/{order_id}/good', 'RepairOrderHasGoodsController@destroy')->name('repair_order_has_goods.destroy')->middleware('my_repair_order');

//RepairOrderDeviceGoodsController
    Route::post('/orders/repair/{device_id}/goods', 'RepairOrderDeviceGoodsController@index')->name('device_has_goods.index')->middleware('my_device');

//RepairOrderPaymentController
    Route::post('/orders/repair/{order_id}/paid', 'RepairOrderPaymentController@store')->name('repair_order_payment.store')->middleware('my_repair_order');

//RepairOrderHasDeviceController
    Route::post('/orders/repair/{order_id}/device', 'RepairOrderHasDeviceController@destroy')->name('repair_order_has_device.destroy')->middleware('my_repair_order');

});
