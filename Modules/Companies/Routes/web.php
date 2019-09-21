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
Route::middleware(['auth', 'admin', 'is_registered'])->group(function () {

    //Companies
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::post('/companies', 'CompaniesController@store')->name('companies.store');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::post('/companies/{company_id}', 'CompaniesController@update')->name('companies.update');
    Route::get('/companies/{company_id}/edit', 'CompaniesController@edit')->name('companies.edit');

    //Branches
    Route::get('/branches/create', 'BranchesController@create')->name('branches.create');
    Route::post('/branches', 'BranchesController@store')->name('branches.store');
    Route::post('/branches/{branch_id}', 'BranchesController@update')->name('branches.update');
    Route::delete('/branches/{branch_id}', 'BranchesController@destroy')->name('branches.destroy');

});
