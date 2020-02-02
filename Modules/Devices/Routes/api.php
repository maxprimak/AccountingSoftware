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

Route::post('/devices/{customer_id}', "DevicesController@store")->name('devices.store');
Route::post('/devices/update/{device_id}', "DevicesController@update")->name('devices.update');
Route::get('/customers/devices/{customer_id}', "CustomerDeviceController@index")->name('customers.devices.index');

//DeviceHasService
Route::get('/device_has_services/{device_id}', 'DeviceHasServiceController@show')->name('device_has_service.show');

//UseGood
Route::post('devices/goods/use', 'DeviceGoodsController@store')->name('device.goods.store');

Route::post('/service/complete', 'DeviceHasServiceController@update')->name('services.complete');

});