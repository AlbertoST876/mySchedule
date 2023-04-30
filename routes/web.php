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

    Route::controller(UserController::class) -> group(function() {
        Route::get("login", "index") -> name("login");
        Route::post("login", "show");
        Route::get("register", "create") -> name("register");
        Route::post("register", "store");
        Route::get("settings", "edit") -> name("settings");
        Route::patch("settings/update", "update") -> name("settings.update");
        Route::post("logout", "destroy") -> name("logout");
    });

    Route::controller(CalendarController::class) -> group(function() {
        Route::redirect("calendar", "calendar/month", 301) -> name("calendar");
        Route::get("calendar/day", "day") -> name("calendar.day");
        Route::get("calendar/week", "week") -> name("calendar.week");
        Route::get("calendar/month", "month") -> name("calendar.month");
        Route::get("calendar/year", "year") -> name("calendar.year");
    });

    Route::controller(EventsController::class) -> group(function() {
        Route::get("events", "index") -> name("events");
        Route::post("events/create", "store") -> name("events.create");
        Route::post("events/show", "show") -> name("events.show");
        Route::post("events/edit", "edit") -> name("events.edit");
        Route::patch("events/update", "update") -> name("events.update");
        Route::post("events/destroy", "destroy") -> name("events.destroy");
    });
});
