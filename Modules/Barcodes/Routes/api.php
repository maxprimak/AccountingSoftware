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

Route::middleware(['is_authorized', 'is_registered'])->prefix('barcodes')->group(function() {
    Route::post('/', 'BarcodesController@store');
    Route::post('/generate', 'BarcodesController@generate');
    Route::get('/download/{id}', 'BarcodesController@downloadBarcodeIMG');
});
