<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RememberEmail;
use App\Models\Event;

Artisan::command("inspire", function() {
    $this -> comment(Inspiring::quote());
}) -> purpose("Display an inspiring quote") -> hourly();

Schedule::call(function() {
    $events = Event::where("remember", "<=", DB::raw("NOW()")) -> where("isRemembered", false) -> get();

    foreach ($events as $event) {
        Mail::to($event -> user -> email) -> send(new RememberEmail($event));
        Event::where("id", $event -> id) -> update(["isRemembered" => true]);
    }
}) -> everyMinute();
