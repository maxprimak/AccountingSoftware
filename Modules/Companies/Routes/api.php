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

Route::middleware(['is_authorized', 'is_registered', 'employee', 'admin'])->group(function () {

Route::get('companies', 'CompaniesController@index')->name('companies.index');
Route::post('companies/{company_id}', 'CompaniesController@update')->name('companies.update');

Route::get('branches', 'BranchesController@index')->name('branches.index');
Route::post('branches', 'BranchesController@store')->name('branches.store');
Route::post('branches/{branch_id}', 'BranchesController@update')->name('branches.update');
Route::delete('branches/{branch_id}', 'BranchesController@destroy')->name('branches.destroy');

Route::get('currencies', 'CurrenciesController@index')->name('currencies.index');

});
