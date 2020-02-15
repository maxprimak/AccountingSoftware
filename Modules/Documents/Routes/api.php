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
    
    Route::get('/receipts/show/{repair_order_id}', 'ReceiptsController@show')->name('receipts.show')->middleware('my_repair_order');
    Route::get('/receipts/text/{repair_order_id}/language/{language_id}', 'ReceiptsTextController@show')->name('receipts.text.show')->middleware('my_repair_order');
    Route::post('/receipts/text/{repair_order_id}/language/{language_id}', 'ReceiptsTextController@update')->name('receipts.text.update')->middleware('my_repair_order');

});