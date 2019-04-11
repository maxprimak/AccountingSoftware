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
    //Dashboard Routes
    Route::get('/dashboard', 'DashboardController@showDashboard');
    //PDF Routes
    Route::get('/kostenvoranschlag/edit/{id}', 'DashboardController@showKostenvoranschlag')->name('kostenvoranschlag');
    Route::get('/kostenvoranschlag/all', 'DashboardController@showAllKostenvoranschlage')->name('kostenvoranschlag.all');
    Route::post('/kostenvoranschlag/create', 'DashboardController@createKostenvoranschlag')->name('kostenvoranschlag.create');
    Route::post('/kostenvoranschlag/update/{id}', 'DashboardController@updateKostenvoranschlag');
    Route::get('/kaufvertrag', 'DashboardController@showKaufvertrag')->name('kaufvertrag');
    Route::get('/rechnung_hand_dif', 'DashboardController@showRechnungHandDif')->name('rechnung_hand_dif');
});

/* middleware(['auth', 'verified']) - access only with verified email */
