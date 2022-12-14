<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'App\Http\Controllers\DashboardController@index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/tickets', 'App\Http\Controllers\TicketController@show')->name('ticket.show');
    Route::post('/tickets', 'App\Http\Controllers\TicketController@store')->name('ticket.store');
    Route::get('/tickets/{id}', 'App\Http\Controllers\TicketController@delete')->name('ticket.delete');
    Route::get('/tickets/share/{league_id}/{match_id}', 'App\Http\Controllers\TicketShareController@share')->name('ticket.share');
    Route::get('/tickets/booking/{league_id}/{match_id}', 'App\Http\Controllers\TicketShareController@booking')->name('ticket.booking');

    Route::get('/admin/settings', 'App\Http\Controllers\AdminController@show_settings')->name('admin.settings');
    Route::post('/admin/settings', 'App\Http\Controllers\AdminController@store_settings')->name('admin.store_settings');
});
