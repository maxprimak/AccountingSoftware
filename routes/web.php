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

Route::get('/', function () {
    return view('dashboard::dashboard');
});

Route::get('/repair-orders', function () {
    return view('orders::RepairOrders');
});
Route::get('/sales-orders', function () {
    return view('orders::SalesOrders');
});
Route::get('/orders-settings', function () {
    return view('orders::OrdersSettings');
});
Route::get('/create-repair', function () {
    return view('orders::CreateRepairOrders');
});
Route::get('/create-sales', function () {
    return view('orders::CreateSalesOrders');
});

Route::get('/home', function () {
    return view('dashboard::dashboard');
});

});

Route::get("/v2", function(){
   return view("main");
});
