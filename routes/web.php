<?php

use Illuminate\Support\Facades\Route;
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

Route::redirect("calendar", "calendar/month", 301) -> name("calendar");
Route::view("calendar/day", "calendar.day") -> name("calendar.day");
Route::view("calendar/week", "calendar.week") -> name("calendar.week");
Route::view("calendar/month", "calendar.month") -> name("calendar.month");
Route::view("calendar/year", "calendar.year") -> name("calendar.year");

Route::get("events", [EventsController::class, "index"]) -> name("events");
Route::get("events/show", [EventsController::class, "show"]) -> name("events.show");
Route::get("events/edit", [EventsController::class, "edit"]) -> name("events.edit");