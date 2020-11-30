<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['is_authorized', 'is_registered'])->group(function () {
    Route::post('/statistics/newCustomers', "NewCustomersStatisticsController@index");
    Route::post('/statistics/totalRevenue', "TotalRevenueStatisticsController@index");
    Route::post('/statistics/workshop', "WorkshopStatisticsController@index");

    Route::post('/kpi/newLeads', "NewLeadsKpiController@index");
    Route::post('/kpi/sales', "SalesKpiController@index");
    Route::post('/kpi/orders', "OrdersKpiController@index");
    Route::post('/kpi/expense', "ExpenseKpiController@index");
});
