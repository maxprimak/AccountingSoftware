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

Route::post('/orders/repair', 'RepairOrdersController@store')->name('orders.repair.store');
Route::post('/orders/repair/{order_id}', 'RepairOrdersController@update')->name('orders.repair.update');
Route::get('/orders/repair/branch/{branch_id}', 'RepairOrdersBranchController@index')->name('orders.repair.branch.index');

Route::post('/orders/sales', 'SalesOrdersController@store')->name('orders.sales.store');
Route::post('/orders/sales/{order_id}', 'SalesOrdersController@update')->name('orders.sales.update');
//Route::get('/orders/sales/branch/{branch_id}', 'SalesOrdersBranchController@index')->name('orders.sales.branch.index');