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

Route::middleware(['is_authorized'])->group(function () {

Route::get('companies', 'CompaniesController@index');
Route::post('companies/{company_id}', 'CompaniesController@update');

Route::get('branches', 'BranchesController@index');
Route::post('branches', 'BranchesController@store');
Route::post('branches/{branch_id}', 'BranchesController@update');
Route::delete('branches/{branch_id}', 'BranchesController@destroy');

});
