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
    //BRANDS
    Route::get('brands', 'BrandsController@index')->name('brands.index');
    Route::post('brands', 'BrandsController@store')->name('brands.store');

    //Models
    Route::get('models/{brand_id}', 'ModelsController@index')->name('models.index')->middleware('my_brand');
    Route::post('models', 'ModelsController@store')->name('models.store');

    //SubModels
    Route::get('submodels/{model_id}', 'SubmodelController@index')->name('submodels.index')->middleware('my_model');
    Route::post('submodels', 'SubmodelController@store')->name('submodels.store');
    Route::get('submodels/show/{submodel_id}', 'SubmodelController@show')->name('submodels.show')->middleware('my_submodel');

    //Parts
    Route::get('parts', 'PartsController@index')->name('parts.index');
    Route::post('parts', 'PartsController@store')->name('parts.store');
    Route::get('parts/{part_id}', 'PartsController@show')->name('parts.show')->middleware('my_part');

    //Colors
    Route::get('colors', 'ColorsController@index')->name('colors.index');
    Route::post('colors', 'ColorsController@store')->name('colors.store');
    Route::get('colors/{color_id}', 'ColorsController@show')->name('colors.show')->middleware('my_color');

    //Goods
    Route::get('goods', 'GoodsController@index')->name('goods.index');
    Route::get('goods/{warehouse_id}', 'GoodsController@show')->name('goods.show')->middleware('my_warehouse');
    Route::post('goods', 'GoodsController@store')->name('goods.store');
    Route::post('goods/{good_id}', 'GoodsController@update')->name('goods.update')->middleware('my_good');
    Route::post('goods_warehouses/search', 'GoodsController@search')->name('goods.search');
});
