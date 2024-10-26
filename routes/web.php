<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UserController;

Route::group(["prefix" => LaravelLocalization::setLocale()], function() {
    Route::view("", "index") -> name("index");

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
        Route::prefix("calendar") -> group(function() {
            Route::name("calendar.") -> group(function() {
                Route::get("", "index") -> name("index");
                Route::get("day", "day") -> name("day");
                Route::get("week", "week") -> name("week");
                Route::get("month", "month") -> name("month");
                Route::get("year", "year") -> name("year");
            });
        });
    });

    Route::controller(EventsController::class) -> group(function() {
        Route::prefix("events") -> group(function() {
            Route::name("events.") -> group(function() {
                Route::get("", "index") -> name("index");
                Route::post("store", "store") -> name("store");
                Route::post("show", "show") -> name("show");
                Route::post("edit", "edit") -> name("edit");
                Route::put("update", "update") -> name("update");
                Route::delete("destroy", "destroy") -> name("destroy");
            });
        });
    });

    Route::controller(VerificationController::class) -> group(function() {
        Route::prefix("email/verify") -> group(function() {
            Route::name("verification.") -> group(function() {
                Route::get("", "notice") -> name("notice");
                Route::get("{id}/{hash}", "verify") -> name("verify");
            });
        });
    });
});
