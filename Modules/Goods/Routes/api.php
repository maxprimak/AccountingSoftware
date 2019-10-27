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
    Route::get('models/{brand_id}', 'ModelsController@index')->name('models.index');
    Route::post('models', 'ModelsController@store')->name('models.store');

    //SubModels
    Route::get('submodels/{model_id}', 'SubmodelController@index')->name('submodels.index');
    Route::post('submodels', 'SubmodelController@store')->name('submodels.store');

    //Parts
    Route::get('parts', 'PartsController@index')->name('parts.index');
    Route::post('parts', 'PartsController@store')->name('parts.store');

    //Colors
    Route::get('colors', 'ColorsController@index')->name('colors.index');
    Route::post('colors', 'ColorsController@store')->name('colors.store');

    //Goods
    Route::get('goods/{branch_id}', 'GoodsController@index')->name('goods.index');
    Route::post('goods', 'GoodsController@store')->name('goods.store');
    Route::post('goods/{good_id}', 'GoodsController@update')->name('goods.update');
    Route::delete('goods/{good_id}', 'GoodsController@destroy')->name('goods.delete');

});
