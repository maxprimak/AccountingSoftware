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
    Route::post('/pdf/rechnung_hand_dif', 'PDFController@rechnungHandDif');
    Route::post('/pdf/kostenvoranschlag', 'PDFController@kostenVoranschlag');
    Route::post('/pdf/kaufvertrag', 'PDFController@kaufVertrag');
});

/* middleware(['auth', 'verified']) - access only with verified email */
