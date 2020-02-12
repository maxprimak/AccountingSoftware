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

Route::get('cities/{country_id}', 'CitiesController@index')->name('cities.index');
Route::get('currencies', 'CurrenciesController@index')->name('currencies.index');
Route::get('countries', 'CountriesController@index')->name('countries.index');

});


Route::middleware(['is_authorized', 'is_registered'])->group(function () {

Route::get('companies', 'CompaniesController@index')->name('companies.index');
Route::post('companies/{company_id}', 'CompaniesController@update')->name('companies.update')->middleware('my_company');
Route::post('companies', 'CompaniesController@store')->name('companies.store');

Route::get('branches', 'BranchesController@index')->name('branches.index');
Route::post('branches', 'BranchesController@store')->name('branches.store');
Route::post('branches/{branch_id}', 'BranchesController@update')->name('branches.update')->middleware('my_branch');
Route::delete('branches/{branch_id}', 'BranchesController@destroy')->name('branches.destroy')->middleware('my_branch');

Route::post('payment/subscription/make', 'PaymentController@store')->name('payment.subscription.store');
Route::post('payment/method/attach', 'PaymentController@attachMethod')->name('payment.method.attach');

});
