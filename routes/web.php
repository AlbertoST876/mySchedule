<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UserController;

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

Route::view("login", "auth.login") -> name("login") -> middleware("guest");
Route::post("login", [UserController::class, "index"]);
Route::view("register", "auth.register") -> name("register") -> middleware("guest");
Route::post("register", [UserController::class, "store"]);
Route::post("logout", [UserController::class, "destroy"]) -> name("logout") -> middleware("auth");

Route::redirect("calendar", "calendar/month", 301) -> name("calendar") -> middleware("auth");
Route::get("calendar/day", [CalendarController::class, "day"]) -> name("calendar.day") -> middleware("auth");
Route::get("calendar/week", [CalendarController::class, "week"]) -> name("calendar.week") -> middleware("auth");
Route::get("calendar/month", [CalendarController::class, "month"]) -> name("calendar.month") -> middleware("auth");
Route::get("calendar/year", [CalendarController::class, "year"]) -> name("calendar.year") -> middleware("auth");

Route::get("events", [EventsController::class, "index"]) -> name("events") -> middleware("auth");
Route::post("events/create", [EventsController::class, "store"]) -> name("events.create") -> middleware("auth");
Route::post("events/show", [EventsController::class, "show"]) -> name("events.show") -> middleware("auth");
Route::post("events/edit", [EventsController::class, "edit"]) -> name("events.edit") -> middleware("auth");
Route::patch("events/update", [EventsController::class, "update"]) -> name("events.update") -> middleware("auth");
Route::post("events/delete", [EventsController::class, "destroy"]) -> name("events.delete") -> middleware("auth");