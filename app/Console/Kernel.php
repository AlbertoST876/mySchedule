<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule -> call(function() {
            $events = DB::table("events") -> leftJoin("users", "events.user_id", "users.id") -> where("events.remember", "<=", DB::raw("NOW()")) -> where("events.isRemembered", false) -> select("events.id", "users.email", "events.name", "events.description", "events.date") -> get();

            foreach ($events as $event) {
                mail($event -> email, $event -> name, $event -> description);

                DB::table("events") -> where("id", $event -> id) -> update(["isRemembered" => true]);
            }
        }) -> everyTwoMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
