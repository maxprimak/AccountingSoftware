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

Route::get('/warehouses', 'WarehouseController@index')->name('warehouse.index');
Route::post('/warehouse', 'WarehouseController@store')->name('warehouse.store');
Route::post('/warehouse/{warehouse_id}', 'WarehouseController@update')->name('warehouse.update');
// Route::get('/orders/repair/branch/{branch_id}', 'RepairOrdersBranchController@index')->name('orders.repair.branch.index')->middleware('my_branch');
Route::delete('/warehouse_has_good/{warehouse_has_good_id}', 'WarehouseHasGoodController@destroy')->name('warehouse_has_good.delete');
Route::post('/warehouse_has_good/move', 'WarehouseHasGoodController@moveGoodToWarehouse')->name('warehouse_has_good.moveGoodToWarehouse');
Route::post('/warehouse_has_good/{warehouse_has_good_id}', 'WarehouseHasGoodController@update')->name('warehouse_has_good.update');

});
