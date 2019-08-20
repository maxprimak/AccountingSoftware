<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/reg_steps', 'CompaniesController@showRegSteps');
    Route::post('/reg_steps/submit', 'CompaniesController@submitRegSteps');
    Route::get('/add_employees/{id}', 'CompaniesController@showAddEmployees');

    //Module routes
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::post('/companies', 'CompaniesController@store')->name('companies.store');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::patch('/companies/{company_id}', 'CompaniesController@update')->name('companies.update');
    Route::get('/companies/{company_id}/edit', 'CompaniesController@edit')->name('companies.edit');

});

