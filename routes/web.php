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

Route::group(["prefix" => LaravelLocalization::setLocale()], function() {
    Route::view("/", "index") -> name("index");

    Route::get("login", [UserController::class, "index"]) -> name("login");
    Route::post("login", [UserController::class, "show"]);
    Route::get("register", [UserController::class, "create"]) -> name("register");
    Route::post("register", [UserController::class, "store"]);
    Route::get("settings", [UserController::class, "edit"]) -> name("settings");
    Route::patch("settings/update", [UserController::class, "update"]) -> name("settings.update");
    Route::post("logout", [UserController::class, "destroy"]) -> name("logout");

    Route::redirect("calendar", "calendar/month", 301) -> name("calendar");
    Route::get("calendar/day", [CalendarController::class, "day"]) -> name("calendar.day");
    Route::get("calendar/week", [CalendarController::class, "week"]) -> name("calendar.week");
    Route::get("calendar/month", [CalendarController::class, "month"]) -> name("calendar.month");
    Route::get("calendar/year", [CalendarController::class, "year"]) -> name("calendar.year");

    Route::get("events", [EventsController::class, "index"]) -> name("events");
    Route::post("events/create", [EventsController::class, "store"]) -> name("events.create");
    Route::post("events/show", [EventsController::class, "show"]) -> name("events.show");
    Route::post("events/edit", [EventsController::class, "edit"]) -> name("events.edit");
    Route::patch("events/update", [EventsController::class, "update"]) -> name("events.update");
    Route::post("events/delete", [EventsController::class, "destroy"]) -> name("events.delete");
});
