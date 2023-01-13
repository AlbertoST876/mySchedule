<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventsController;

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

Route::view("/", "index") -> name("index");

Route::get("calendar/day", [CalendarController::class, "day"]) -> name("calendarDay");
Route::get("calendar/week", [CalendarController::class, "week"]) -> name("calendarWeek");
Route::get("calendar/month", [CalendarController::class, "month"]) -> name("calendarMonth");
Route::get("calendar/year", [CalendarController::class, "year"]) -> name("calendarYear");

Route::get("events", [EventsController::class, "index"]) -> name("events");
Route::get("events/show", [EventsController::class, "show"]) -> name("eventsShow");
Route::get("events/edit", [EventsController::class, "edit"]) -> name("eventsEdit");