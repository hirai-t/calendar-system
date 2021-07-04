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
    return redirect('calendar-year');
});


Route::get('calendar-year', "App\Http\Controllers\CalendarYearController@index");
Route::get('calendar-month', "App\Http\Controllers\CalendarMonthController@index")->middleware('auth');
Route::get('calendar-day', "App\Http\Controllers\CalendarDayController@index")->middleware('auth');
Route::post('calendar-schedule-add', "App\Http\Controllers\CalendarScheduleSettingController@post");
Route::post('calendar-schedule-edit', "App\Http\Controllers\CalendarScheduleSettingController@edit");
Route::get('calendar-schedule-delete', "App\Http\Controllers\CalendarScheduleSettingController@delete");
Route::get('calendar-user', "App\Http\Controllers\CalendarAuthController@user")->middleware('auth');
Route::get('calendar-user-delete', "App\Http\Controllers\CalendarAuthController@delete")->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
