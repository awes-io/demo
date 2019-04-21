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

AwesAuth::routes();

# Admin part
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('dashboard');
    });

    # Dashboard
    Route::prefix('dashboard')->as('dashboard.')->namespace('\App\Sections\Dashboard\Controllers')->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
        Route::get('leads/chart', 'DashboardController@leadsChart')->name('leads.chart');
        Route::get('sales/chart', 'DashboardController@salesChart')->name('sales.chart');
        Route::get('leads/chart/doughnut', 'DashboardController@leadsDoughnutChart')->name('leads.doughnut');
    });

    # Leads
    Route::prefix('leads')->as('leads.')->namespace('\App\Sections\Leads\Controllers')->group(function () {
        Route::get('/', 'LeadController@index')->name('index');
        Route::get('scope', 'LeadController@scope')->name('scope');
        Route::get('{id}', 'LeadController@show')->name('show');
        Route::post('/', 'LeadController@store')->name('store');
        Route::patch('{id}', 'LeadController@update')->name('update');
    });

    # Analytics
    Route::prefix('analytics')->as('analytics.')->namespace('\App\Sections\Analytics\Controllers')->group(function () {
        Route::get('/', 'AnalyticController@index')->name('index');
        Route::get('chart/leads', 'AnalyticController@chart')->name('leads.chart');
    });

    // Settings
    Route::prefix('settings')->as('settings.')->namespace('\App\Sections\Settings\Controllers')->group(function () {
        Route::get('/', 'SettingController@index')->name('index');
        Route::post('update', 'SettingController@update')->name('update');
        Route::post('password', 'SettingController@password')->name('password');
    });

});
