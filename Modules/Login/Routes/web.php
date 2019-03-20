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
// Authentication Routes...
Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login', 'LoginController@authenticate');
Route::get('/logout', 'LoginController@logout');

//Registration Routes...
Route::get('/register', 'RegisterController@showRegisterForm')->name('register');
Route::post('/register', 'RegisterController@register');