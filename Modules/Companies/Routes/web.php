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
    Route::get('/companies', 'CompaniesController@index');
    Route::post('/companies', 'CompaniesController@store');
    Route::get('/companies/create', 'CompaniesController@create');
    Route::post('/companies/{company_id}', 'CompaniesController@update');
    Route::get('/companies/{company_id}/edit', 'CompaniesController@edit');
    //Branches
    Route::get('/branches/create', 'BranchesController@create');
    Route::post('/branches', 'BranchesController@store');
    Route::post('/branches/{branch_id}', 'BranchesController@update');
    Route::delete('/branches/{branch_id}', 'BranchesController@destroy');

});
