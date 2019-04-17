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

    //Kostenvoranschlag
    Route::get('/kostenvoranschlag/edit/{id}', 'DashboardController@showKostenvoranschlag');
    Route::get('/kostenvoranschlag/all', 'DashboardController@showAllKostenvoranschlage')->name('kostenvoranschlag.all');
    Route::post('/kostenvoranschlag/create', 'DashboardController@createKostenvoranschlag')->name('kostenvoranschlag.create');
    Route::post('/kostenvoranschlag/update/{id}', 'DashboardController@updateKostenvoranschlag');

    //Kaufvertrag
    Route::get('/kaufvertrag/edit/{id}', 'DashboardController@showKaufvertrag');
    Route::get('/kaufvertrag/all', 'DashboardController@showAllKaufvertrage')->name('kaufvertrag.all');
    Route::post('/kaufvertrag/create', 'DashboardController@createKaufvertrag')->name('kaufvertrag.create');
    Route::post('/kaufvertrag/update/{id}', 'DashboardController@updateKaufvertrag');

    //RechnungHandDif
    Route::get('/rechnung_hand_dif/edit/{id}', 'DashboardController@showRechnungHandDif');
    Route::get('/rechnung_hand_dif/all', 'DashboardController@showAllRechnungHandDifs')->name('rechnung_hand_dif.all');
    Route::post('/rechnung_hand_dif/create', 'DashboardController@createRechnungHandDif')->name('rechnung_hand_dif.create');
    Route::post('/rechnung_hand_dif/update/{id}', 'DashboardController@updateRechnungHandDif');
});

/* middleware(['auth', 'verified']) - access only with verified email */
