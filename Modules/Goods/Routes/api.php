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

Route::middleware(['is_authorized', 'employee', 'is_registered','admin'])->group(function () {
    //BRANDS
    Route::post('brands', 'BrandsController@store')->name('brands.store');

    //Models
    Route::post('models', 'ModelsController@store')->name('models.store');

    //SubModels
    Route::post('submodels', 'SubmodelController@store')->name('submodels.store');

    //Parts
    Route::post('parts', 'PartsController@store')->name('parts.store');

    //Colors
    Route::post('colors', 'ColorsController@store')->name('colors.store');

    //Goods
    Route::get('goods', 'GoodsController@index')->name('goods.index');
    Route::post('goods', 'GoodsController@store')->name('goods.store');
    Route::post('goods/{good_id}', 'GoodsController@update')->name('goods.update');
    Route::delete('goods/{good_id}', 'GoodsController@destroy')->name('goods.delete');

});
